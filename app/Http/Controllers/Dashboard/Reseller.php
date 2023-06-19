<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class Reseller extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Reseller',
            'barang' => Barang::where('kategori', 'Reseller')->get(),
        ];
        return view('dashboard.reseller', $data);
    }

    public function submitTambahBarang(Request $request)
    {
        Barang::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => 'Reseller'
        ]);
        return redirect('/reseller')->with('success', 'Barang telah ditambahkan');
    }

    public function submitEditBarang(Request $request, string $id)
    {
        Barang::where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect('/reseller')->with('success', 'Barang telah diubah');
    }

    public function searchBarang(Request $request)
    {
        $data = [
            'title' => 'Dashboard Reseller',
            'barang' => Barang::where('nama', 'like', '%' . $request->keyword . '%')->where('kategori', 'Reseller')->get(),
        ];
        return view('dashboard.reseller', $data);
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
        return redirect('/reseller')->with('success', 'Pesanan telah diselesaikan');
    }
}
