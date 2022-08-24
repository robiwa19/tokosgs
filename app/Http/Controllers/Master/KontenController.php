<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    public function index() {
        $kontens = Konten::orderBy('id', 'ASC')->get();

        return view('master.konten.index', compact('kontens'));
    }

    public function create() {
        return view('master.konten.create');
    }

    public function createAction(Request $r) {
        $r->validate([
            'code' => 'required',
            'data' => 'required'
        ]);

        if (!in_array($r->code, Konten::acceptedCodes()))
            return redirect('/master-konten')->with('danger', 'Tipe Konten tidak diperbolehkan.');
        if (Konten::where('code', $r->code)->count() >= 1)
            return redirect('/master-konten')->with('danger', 'Data Master Konten ' . Konten::getCodeName($r->code) . ' sudah pernah ditambahkan.');

        $konten = new Konten;
        $konten->code = $r->code;
        $konten->data = $r->data;
        $konten->save();

        return redirect('/master-konten')->with('success', 'Data Master Konten berhasil ditambahkan.');
    }

    public function update($id) {
        $konten = konten::where('id', $id)->first();
        if (!$konten) {
            return redirect('/master-konten')->with('danger', 'Data Master Konten dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.konten.update', compact('konten'));
    }

    public function updateAction(Request $r, $id) {
        $konten = Konten::find($id);
        if (!$konten) {
            return redirect('/master-konten')->with('danger', 'Data Master Konten dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'data' => 'required'
            ]);
            
            if (!in_array($r->code, Konten::acceptedCodes()))
                return redirect('/master-konten')->with('danger', 'Tipe Konten tidak diperbolehkan.');
            
            $konten->data = $r->data;
            $konten->save();

            return redirect('/master-konten')->with('success', 'Data Master Konten dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $konten = Konten::where('id', $id)->first();
        if (!$konten) {
            return redirect('/master-konten')->with('danger', 'Data Master Konten dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.konten.delete', compact('konten'));
    }

    public function deleteAction($id) {
        $konten = Konten::where('id', $id)->first();
        if (!$konten) {
            return redirect('/master-konten')->with('danger', 'Data Master Konten dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            Konten::where('id', $id)->delete();

            return redirect('/master-konten')->with('success', 'Data Master Konten dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
