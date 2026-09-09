<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()

        // Filter berdasarkan role
        ->when($user->role->name === 'kasir', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })

        // Search nama user
           ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();
        
             return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        if($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
        }

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
   public function show(Penjualan $penjualan)
    {
        $penjualan->load('itemPenjualan.produk', 'user');

        $sale = $penjualan;

        // Jika transaksi QRIS, otomatis uang masuk disamakan dengan total pembayaran
        if ($sale->metode_pembayaran === 'QRIS' && (!$sale->uang_masuk || $sale->uang_masuk == 0)) {
            $sale->uang_masuk = $sale->total_pembayaran;
            $sale->uang_kembalian = 0;
        }

        return view('penjualan.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS'
        ], [
            'payment_method.required' => 'Silakan pilih metode pembayaran terlebih dahulu.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses.');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong.');
        }

        $total = $penjualan->itemPenjualan()->sum('subtotal');

        $uangMasuk = $total;
        $uangKembalian = 0;

        if ($request->payment_method === 'CASH') {
            $request->validate([
                'uang_masuk' => 'required|numeric|min:' . $total,
            ], [
                'uang_masuk.required' => 'Uang masuk wajib diisi.',
                'uang_masuk.min' => 'Uang masuk kurang dari total belanja.',
            ]);

            $uangMasuk = $request->uang_masuk;
            $uangKembalian = $uangMasuk - $total;
        }

        DB::transaction(function () use ($request, $penjualan, $total, $uangMasuk, $uangKembalian) {
           $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran' => $total,
                'uang_masuk' => $uangMasuk,
                'uang_kembalian' => $uangKembalian,
                'status' => 'COMPLETED'
           ]); 
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);
        
        // pastikan hanya transaksi OPEN
        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.index')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan.');
        }

        // pastikan milik user login (kasir)
        if ($penjualan->user_id !== Auth::id()) {
            return redirect()->route('penjualan.index')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan.');
        }

        DB::transaction(function () use ($penjualan) {
            
            foreach ($penjualan->itemPenjualan as $item) {
                // kembalikan stok
                $item->produk->increment('stok', $item->kuantitas);
            }

            // hapus item 
            $penjualan->itemPenjualan()->delete();

            // hapus penjualan
            $penjualan->delete();
            
        });

        return redirect()
        ->route('penjualan.index')
        ->with('success', 'Transaksi berhasil dibatalkan.');
}
}