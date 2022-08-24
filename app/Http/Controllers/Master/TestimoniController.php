<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimoniController extends Controller
{
    public function index() {
        $testimonis = Testimoni::orderBy('id', 'ASC')->get();

        return view('master.testimoni.index', compact('testimonis'));
    }

    public function create() {
        return view('master.testimoni.create');
    }

    public function createAction(Request $r) {
        $r->validate([
            'name' => 'required',
            'data' => 'required',
            'profile' => 'required|mimes:jpeg,jpg,png'
        ]);

        $profile = $r->file('profile');
        $upload_location = null;
        if ($profile->isValid()) {
            $filename = Str::random(10) . '.' . $profile->extension();
            $profile->storeAs('public/profiles', $filename);
            $upload_location = '/storage/profiles/' . $filename;
        } else {
            return redirect('/master-testimoni')->with('danger', 'Gagal mengupload profile.');
        }

        $testimoni = new testimoni;
        $testimoni->name = $r->name;
        $testimoni->data = $r->data;
        $testimoni->profile = $upload_location;
        $testimoni->save();

        return redirect('/master-testimoni')->with('success', 'Data Master Testimoni berhasil ditambahkan.');
    }

    public function update($id) {
        $testimoni = Testimoni::where('id', $id)->first();
        if (!$testimoni) {
            return redirect('/master-testimoni')->with('danger', 'Data Master Testimoni dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.testimoni.update', compact('testimoni'));
    }

    public function updateAction(Request $r, $id) {
        $testimoni = Testimoni::find($id);
        if (!$testimoni) {
            return redirect('/master-testimoni')->with('danger', 'Data Master Testimoni dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'name' => 'required',
                'data' => 'required'
            ]);
    
            if ($r->hasFile('profile')) {
                $r->validate(['profile' => 'required|mimes:jpeg,jpg,png']);

                $profile = $r->file('profile');
                $upload_location = null;
                if ($profile->isValid()) {
                    $filename = Str::random(10) . '.' . $profile->extension();
                    $profile->storeAs('public/profiles', $filename);
                    $upload_location = '/storage/profiles/' . $filename;
                } else {
                    return redirect('/master-testimoni')->with('danger', 'Gagal mengupload profile.');
                }
            }
            
            $testimoni->name = $r->name;
            $testimoni->data = $r->data;
            $testimoni->profile = $upload_location ?? $testimoni->profile;
            $testimoni->save();

            return redirect('/master-testimoni')->with('success', 'Data Master Testimoni dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $testimoni = Testimoni::where('id', $id)->first();
        if (!$testimoni) {
            return redirect('/master-testimoni')->with('danger', 'Data Master Testimoni dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.testimoni.delete', compact('testimoni'));
    }

    public function deleteAction($id) {
        $testimoni = Testimoni::where('id', $id)->first();
        if (!$testimoni) {
            return redirect('/master-testimoni')->with('danger', 'Data Master Testimoni dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            Testimoni::where('id', $id)->delete();

            return redirect('/master-testimoni')->with('success', 'Data Master Testimoni dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
