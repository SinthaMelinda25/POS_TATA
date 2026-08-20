<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        $jenis = Jenis::when($keyword, function ($query, $keyword) {
                $query->where('nama', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        // Perbaikan: Menghapus perintah dd($request->all()) agar validasi & penyimpanan berjalan
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Jenis::create($request->only('nama'));

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function edit(Jenis $jeni)
    {
        return view('jenis.edit', ['jenis' => $jeni]);
    }

    public function update(Request $request, Jenis $jeni)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jeni->update($request->only('nama'));

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diupdate.');
    }

    public function destroy(Jenis $jeni)
    {
        $jeni->delete();

        return back()->with('success', 'Jenis berhasil dihapus.');
    }
}
