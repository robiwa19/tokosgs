<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TenantController extends Controller
{
    public function index(Request $r) {
        if ($r->ajax()) {
            $tenants = Tenant::select('*');

            return DataTables::of($tenants)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button onclick="ajax_modal(`Ubah Tenant`, `'. url('/master-tenant/update/' . $row->id) . '`)" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i></button">
                    <button onclick="ajax_modal(`Hapus Tenant`, `'. url('/master-tenant/delete/' . $row->id) . '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button">';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.tenant.index');
    }

    public function create() {
        return view('master.tenant.create');
    }

    public function createAction(Request $r) {
        $r->validate([
            'nama_pemilik' => 'required',
            'no_telp_perusahaan' => 'required|numeric',
            'email_perusahaan' => 'required|email',
            'nik' => 'required|numeric',
            'nama_toko' => 'required',
            'alamat' => 'required',
            'id_prov' => 'required',
            'id_kab' => 'required',
            'id_kec' => 'required',
            'id_kel' => 'required',
            'level' => 'required',
            'jenis_usaha' => 'required',
            'tenant_unggulan' => 'required|numeric',
            'path_logo' => 'required'
        ]);

        $tenant = new Tenant;
        $tenant->kode_tenant = self::generateKodeTenant();
        $tenant->nama_pemilik = $r->nama_pemilik;
        $tenant->no_telp_perusahaan = $r->no_telp_perusahaan;
        $tenant->email_perusahaan = $r->email_perusahaan;
        $tenant->nik = $r->nik;
        $tenant->nama_toko = $r->nama_toko;
        $tenant->alamat = $r->alamat;
        $tenant->id_prov = $r->id_prov;
        $tenant->id_kab = $r->id_kab;
        $tenant->id_kec = $r->id_kec;
        $tenant->id_kel = $r->id_kel;
        $tenant->level = $r->level;
        $tenant->jenis_usaha = $r->jenis_usaha;
        $tenant->tenant_unggulan = $r->tenant_unggulan;
        $tenant->is_has_qris = $r->is_has_qris ?? '0';
        $tenant->is_generated = $r->is_generated ?? '0';
        $tenant->path_logo = $r->path_logo;
        $tenant->created_by = User::auth()->id;
        $tenant->instagram = $r->instagram ?? null;
        $tenant->whatsapp = $r->whatsapp ?? null;
        $tenant->facebook = $r->facebook ?? null;
        $tenant->created_by = User::auth()->id;
        $tenant->save();

        return redirect('/master-tenant')->with('success', 'Data Master Tenant berhasil ditambahkan.');
    }

    public function update($id) {
        $tenant = Tenant::where('id', $id)->first();
        if (!$tenant) {
            return redirect('/master-tenant')->with('danger', 'Data Master Tenant dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.tenant.update', compact('tenant'));
    }

    public function updateAction(Request $r, $id) {
        $tenant = Tenant::find($id);
        if (!$tenant) {
            return redirect('/master-tenant')->with('danger', 'Data Master tenant dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'nama_pemilik' => 'required',
                'no_telp_perusahaan' => 'required|numeric',
                'email_perusahaan' => 'required|email',
                'nik' => 'required|numeric',
                'nama_toko' => 'required',
                'alamat' => 'required',
                'id_prov' => 'required',
                'id_kab' => 'required',
                'id_kec' => 'required',
                'id_kel' => 'required',
                'level' => 'required',
                'jenis_usaha' => 'required',
                'tenant_unggulan' => 'required|numeric',
                'path_logo' => 'required'
            ]);
            
            $tenant->kode_tenant = self::generateKodeTenant();
            $tenant->nama_pemilik = $r->nama_pemilik;
            $tenant->no_telp_perusahaan = $r->no_telp_perusahaan;
            $tenant->email_perusahaan = $r->email_perusahaan;
            $tenant->nik = $r->nik;
            $tenant->nama_toko = $r->nama_toko;
            $tenant->alamat = $r->alamat;
            $tenant->id_prov = $r->id_prov;
            $tenant->id_kab = $r->id_kab;
            $tenant->id_kec = $r->id_kec;
            $tenant->id_kel = $r->id_kel;
            $tenant->level = $r->level;
            $tenant->jenis_usaha = $r->jenis_usaha;
            $tenant->tenant_unggulan = $r->tenant_unggulan;
            $tenant->is_has_qris = $r->is_has_qris ?? '0';
            $tenant->is_generated = $r->is_generated ?? '0';
            $tenant->path_logo = $r->path_logo;
            $tenant->instagram = $r->instagram ?? $tenant->instagram;
            $tenant->whatsapp = $r->whatsapp ?? $tenant->whatsapp;
            $tenant->facebook = $r->facebook ?? $tenant->facebook;
            $tenant->updated_by = User::auth()->id;
            $tenant->save();

            return redirect('/master-tenant')->with('success', 'Data Master Tenant dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $tenant = Tenant::where('id', $id)->first();
        if (!$tenant) {
            return redirect('/master-tenant')->with('danger', 'Data Master Tenant dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.tenant.delete', compact('tenant'));
    }

    public function deleteAction($id) {
        $tenant = Tenant::where('id', $id)->first();
        if (!$tenant) {
            return redirect('/master-tenant')->with('danger', 'Data Master Tenant dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            tenant::where('id', $id)->delete();

            return redirect('/master-tenant')->with('success', 'Data Master Tenant dengan ID #' . $id . ' berhasil dihapus.');
        }
    }

    public static function generateKodeTenant() {
        $last_tenant = Tenant::orderBy('kode_tenant', 'DESC')->first();

        $length = 7;
        if (!$last_tenant) {
            $kode_tenant = '0000001';
        } else {
            $kode_tenant = ((int)$last_tenant->kode_tenant)+1;
            for ($i = 1; $i < $length; $i++) {
                if (strlen($kode_tenant) < $length) {
                    $kode_tenant = "0" . $kode_tenant;
                }
            }
        }

        return $kode_tenant;
    }
}
