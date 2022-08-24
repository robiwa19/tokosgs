<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index() {
        $configs = Config::orderBy('id', 'ASC')->get();

        return view('master.config.index', compact('configs'));
    }

    public function create() {
        return view('master.config.create');
    }

    public function createAction(Request $r) {
        $r->validate([
            'tahun' => 'required|numeric',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'is_default' => 'required|numeric',
            'maksimal_hari' => 'required|numeric',
            'harga_per_poin' => 'required|numeric',
            'kepolisian' => 'required',
            'dinas_sosial' => 'required',
            'notaris' => 'required',
            'ketua_panitia' => 'required',
            'telepon' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required',
            'logo' => 'required|mimes:jpeg,jpg,png'
        ]);

        $logo = $r->file('logo');
        $upload_location = null;
        if ($logo->isValid()) {
            $filename = Str::random(10) . '.' . $logo->extension();
            $logo->storeAs('public/logos', $filename);
            $upload_location = '/storage/logos/' . $filename;
        } else {
            return redirect('/master-config')->with('danger', 'Gagal mengupload logo.');
        }

        $config = new Config;
        $config->tahun = $r->tahun;
        $config->tgl_awal = $r->tgl_awal;
        $config->tgl_akhir = $r->tgl_akhir;
        $config->is_default = $r->is_default;
        $config->maksimal_hari = $r->maksimal_hari;
        $config->harga_per_poin = $r->harga_per_poin;
        $config->kepolisian = $r->kepolisian;
        $config->dinas_sosial = $r->dinas_sosial;
        $config->notaris = $r->notaris;
        $config->ketua_panitia = $r->ketua_panitia;
        $config->telepon = $r->telepon;
        $config->email = $r->email;
        $config->alamat = $r->alamat;
        $config->logo = $upload_location;
        $config->save();

        return redirect('/master-config')->with('success', 'Data Master Config berhasil ditambahkan.');
    }

    public function update($id) {
        $config = Config::where('id', $id)->first();
        if (!$config) {
            return redirect('/master-config')->with('danger', 'Data Master Config dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.config.update', compact('config'));
    }

    public function updateAction(Request $r, $id) {
        $config = Config::find($id);
        if (!$config) {
            return redirect('/master-config')->with('danger', 'Data Master Config dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'tahun' => 'required|numeric',
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required',
                'is_default' => 'required|numeric',
                'maksimal_hari' => 'required|numeric',
                'harga_per_poin' => 'required|numeric',
                'kepolisian' => 'required',
                'dinas_sosial' => 'required',
                'notaris' => 'required',
                'ketua_panitia' => 'required',
                'telepon' => 'required|numeric',
                'email' => 'required|email',
                'alamat' => 'required'
            ]);

            if ($r->hasFile('logo')) {
                $r->validate(['logo' => 'required|mimes:jpeg,jpg,png']);

                $logo = $r->file('logo');
                $upload_location = null;
                if ($logo->isValid()) {
                    $filename = Str::random(10) . '.' . $logo->extension();
                    $logo->storeAs('public/logos', $filename);
                    $upload_location = '/storage/logos/' . $filename;
                } else {
                    return redirect('/master-config')->with('danger', 'Gagal mengupload logo.');
                }
            }

            $config->tahun = $r->tahun;
            $config->tgl_awal = $r->tgl_awal;
            $config->tgl_akhir = $r->tgl_akhir;
            $config->is_default = $r->is_default;
            $config->maksimal_hari = $r->maksimal_hari;
            $config->harga_per_poin = $r->harga_per_poin;
            $config->kepolisian = $r->kepolisian;
            $config->dinas_sosial = $r->dinas_sosial;
            $config->notaris = $r->notaris;
            $config->ketua_panitia = $r->ketua_panitia;
            $config->telepon = $r->telepon;
            $config->email = $r->email;
            $config->alamat = $r->alamat;
            $config->logo = $upload_location ?? $config->logo;
            $config->save();

            return redirect('/master-config')->with('success', 'Data Master Config dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $config = Config::where('id', $id)->first();
        if (!$config) {
            return redirect('/master-config')->with('danger', 'Data Master Config dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.config.delete', compact('config'));
    }

    public function deleteAction($id) {
        $config = Config::where('id', $id)->first();
        if (!$config) {
            return redirect('/master-config')->with('danger', 'Data Master Config dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            Config::where('id', $id)->delete();

            return redirect('/master-config')->with('success', 'Data Master Config dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
