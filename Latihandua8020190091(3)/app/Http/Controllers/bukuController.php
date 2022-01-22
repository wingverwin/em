<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bukuController extends Controller
{
    public function index()
    {
        $data['objek']  = \App\buku::latest()->paginate(10);
        return view('buku_index', $data);
    }

    public function tambah()
    {
        $data['objek'] = new \App\buku();
        $data['action'] = 'bukuController@simpan';
        $data['method'] = 'POST';
        $data['nama_tombol'] = 'SIMPAN';
        return view('buku_form', $data);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:2',
            'pengarang' => 'required|min:2',
        ]);

        $objek = new \App\buku();
        $objek->judul = $request->judul;
        $objek->pengarang = $request->pengarang;
        $objek->save();
        return back()->with('pesan', 'buku sudah disimpan');
    }
    public function edit($id)
    {
        $data['objek'] = \App\buku::findOrFail($id);
        $data['action'] = ['bukuController@update', $id];
        $data['method'] = 'PUT';
        $data['nama_tombol'] = 'Update';
        return view('buku_form', $data);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
                'judul' => 'required|min:2',
                'pengarang' => 'required|min:2',
            ]);

            $objek = \App\buku::findOrFail($id);
            $objek->judul = $request->judul;
            $objek->pengarang = $request->pengarang;
            $objek->save();
            return redirect('admin/buku/index')->with('pesan', 'Data buku Sudah Diupdate');
    }
    public function hapus($id)
    {
        $objek = \App\buku::findOrFail($id);
        $objek->delete();
        return back()->with('pesan', 'Data Berhasil Dihapus');
    }
    
}
