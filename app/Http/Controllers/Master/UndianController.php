<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Undian;
use App\Models\User;
use Illuminate\Http\Request;

class UndianController extends Controller
{
    public function index() {
        $undians = Undian::orderBy('id', 'ASC')->get();

        return view('master.undian.index', compact('undians'));
    }

    public function create() {
        return view('master.undian.create');
    }

    public function createAction(Request $r) {
        $r->validate([
            'tahun' => 'required|numeric',
            'id_peringkat' => 'required|numeric',
            'keterangan_hadiah' => 'required',
            'jumlah' => 'required|numeric',
            'is_generated' => 'required|numeric',
            'is_generated_view' => 'required|numeric'
        ]);

        $undian = new Undian;
        $undian->tahun = $r->tahun;
        $undian->id_peringkat = $r->id_peringkat;
        $undian->keterangan_hadiah = $r->keterangan_hadiah;
        $undian->jumlah = $r->jumlah;
        $undian->is_generated = $r->is_generated;
        $undian->is_generated_view = $r->is_generated_view;
        $undian->created_by = User::auth()->id;
        $undian->save();

        return redirect('/master-undian')->with('success', 'Data Master Undian berhasil ditambahkan.');
    }

    public function update($id) {
        $undian = Undian::where('id', $id)->first();
        if (!$undian) {
            return redirect('/master-undian')->with('danger', 'Data Master Undian dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.undian.update', compact('undian'));
    }

    public function updateAction(Request $r, $id) {
        $undian = Undian::find($id);
        if (!$undian) {
            return redirect('/master-undian')->with('danger', 'Data Master Undian dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'tahun' => 'required|numeric',
                'id_peringkat' => 'required|numeric',
                'keterangan_hadiah' => 'required',
                'jumlah' => 'required|numeric',
                'is_generated' => 'required|numeric',
                'is_generated_view' => 'required|numeric'
            ]);

            $undian->tahun = $r->tahun;
            $undian->id_peringkat = $r->id_peringkat;
            $undian->keterangan_hadiah = $r->keterangan_hadiah;
            $undian->jumlah = $r->jumlah;
            $undian->is_generated = $r->is_generated;
            $undian->is_generated_view = $r->is_generated_view;
            $undian->created_by = User::auth()->id;
            $undian->save();

            return redirect('/master-undian')->with('success', 'Data Master Undian dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $undian = Undian::where('id', $id)->first();
        if (!$undian) {
            return redirect('/master-undian')->with('danger', 'Data Master Undian dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.undian.delete', compact('undian'));
    }

    public function deleteAction($id) {
        $undian = Undian::where('id', $id)->first();
        if (!$undian) {
            return redirect('/master-undian')->with('danger', 'Data Master Undian dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            undian::where('id', $id)->delete();

            return redirect('/master-undian')->with('success', 'Data Master Undian dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
