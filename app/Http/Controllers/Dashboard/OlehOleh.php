<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OlehOleh extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Oleh - Oleh',
            'barang' => Barang::where('kategori', 'Oleh - Oleh')->get(),
        ];
        return view('dashboard.oleh-oleh', $data);
    }

    public function submitTambahBarang(Request $request)
    {
        Barang::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => 'Oleh - Oleh'
        ]);
        return redirect('/oleh-oleh')->with('success', 'Barang telah ditambahkan');
    }

    public function submitEditBarang(Request $request, string $id)
    {
        Barang::where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect('/oleh-oleh')->with('success', 'Barang telah diubah');
    }

    public function searchBarang(Request $request)
    {
        $data = [
            'title' => 'Dashboard Oleh - Oleh',
            'barang' => Barang::where('nama', 'like', '%' . $request->keyword . '%')->where('kategori', 'Oleh - Oleh')->get(),
        ];
        return view('dashboard.oleh-oleh', $data);
    }

    public function submitPesanan(Request $request)
    {
        $data = json_decode($request->data_pesanan);
        foreach ($data as $item) {
            foreach ($item as $subItem) {
                $stok = Barang::where('id', $subItem->id)->value('stok');
                $terjual = Barang::where('id', $subItem->id)->value('terjual');
                Barang::where('id', $subItem->id)->update([
                    'stok' => $stok - $subItem->jumlah,
                    'terjual' => $terjual + $subItem->jumlah,
                ]);
            }
        }
        return redirect('/oleh-oleh')->with('success', 'Pesanan telah diselesaikan');
    }
}
