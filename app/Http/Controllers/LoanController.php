<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
  

    public function index()
    {
        // Menampilkan daftar barang untuk dipinjam
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function myLoans()
    {
        // Menampilkan daftar pinjaman user yang sedang login
        $loans = Loan::with('item')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('loans.index', compact('loans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
        ]);



        return DB::transaction(function () use ($request) {
            
     
            $item = Item::where('id', $request->item_id)->lockForUpdate()->first();

            
            if ($item->stock <= 0) {
            
                return redirect()->back()->withErrors(['msg' => 'Stok barang habis!']);
            }

            // 3. Kurangi Stok
            $item->stock -= 1;
            $item->save();

            // 4. Catat Peminjaman
            Loan::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
                'loan_date' => Carbon::now(),
                'status' => 'borrowed',
            ]);

            return redirect()->route('items.index')->with('success', 'Berhasil meminjam barang!');
        });
    }

    public function returnItem($loanId)
    {
        return DB::transaction(function () use ($loanId) {
            
            $loan = Loan::where('id', $loanId)
                        ->where('status', 'borrowed')
                        ->firstOrFail();

          
            $loan->update([
                'status' => 'returned',
                'return_date' => Carbon::now(),
            ]);

           
            $item = Item::where('id', $loan->item_id)->lockForUpdate()->first();
            
         
            $item->stock += 1;
            $item->save();

            return redirect()->route('loans.index')->with('success', 'Barang berhasil dikembalikan!');
        });
    }
}