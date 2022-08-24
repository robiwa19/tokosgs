<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriTenant;
use App\Models\User;
use Illuminate\Http\Request;

class KategoriTenantController extends Controller
{
    public function index(Request $r) {
        $kategori_tenants = KategoriTenant::all();

        return view('master.kategori_tenant.index', compact('kategori_tenants'));
    }

    public function create() {
        $induk_kategori = KategoriTenant::all();

        return view('master.kategori_tenant.create', compact('induk_kategori'));
    }

    public function createAction(Request $r) {
        $r->validate([
            'nama_kategori' => 'required'
        ]);
        
        $kategori_tenant = new KategoriTenant;
        $kategori_tenant->nama_kategori = $r->nama_kategori;
        $kategori_tenant->path_file = '';
        if ($r->has('id_induk_kategori')) {
            $induk_kategori = KategoriTenant::where('id', $r->id_induk_kategori)->first();
            if (!$induk_kategori) {
                return redirect('/master-kategori-tenant')->with('danger', 'Induk Kategori tidak ditemukan.');
            } else {
                $kategori_tenant->id_induk_kategori = $induk_kategori->id;
                $kategori_tenant->level = '2';
            }
        } else {
            $kategori_tenant->level = '1';
        }
        $kategori_tenant->icon = $r->icon;
        $kategori_tenant->created_by = User::auth()->id;
        $kategori_tenant->save();

        return redirect('/master-kategori-tenant')->with('success', 'Data Master Kategori Tenant berhasil ditambahkan.');
    }

    public function update($id) {
        $induk_kategori = KategoriTenant::all();
        $kategori_tenant = KategoriTenant::where('id', $id)->first();
        if (!$kategori_tenant) {
            return redirect('/master-kategori-tenant')->with('danger', 'Data Master Kategori Tenant dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.kategori_tenant.update', [
            'induk_kategori' => $induk_kategori,
            'kategori_tenant' => $kategori_tenant
        ]);
    }

    public function updateAction(Request $r, $id) {
        $kategori_tenant = KategoriTenant::find($id);
        if (!$kategori_tenant) {
            return redirect('/master-kategori-tenant')->with('danger', 'Data Master Kategori Tenant dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'nama_kategori' => 'required'
            ]);
            
            $kategori_tenant->nama_kategori = $r->nama_kategori;
            if ($r->has('id_induk_kategori')) {
                $induk_kategori = KategoriTenant::where('id', $r->id_induk_kategori)->first();
                if (!$induk_kategori) {
                    return redirect('/master-kategori-tenant')->with('danger', 'Induk Kategori tidak ditemukan.');
                } else {
                    $kategori_tenant->id_induk_kategori = $induk_kategori->id;
                    $kategori_tenant->level = '2';
                }
            } else {
                $kategori_tenant->level = '1';
            }
            $kategori_tenant->icon = $r->icon;
            $kategori_tenant->updated_by = User::auth()->id;
            $kategori_tenant->save();

            return redirect('/master-kategori-tenant')->with('success', 'Data Master Kategori Tenant dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $kategori_tenant = KategoriTenant::where('id', $id)->first();
        if (!$kategori_tenant) {
            return redirect('/master-kategori-tenant')->with('danger', 'Data Master Kategori Tenant dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.kategori_tenant.delete', compact('kategori_tenant'));
    }

    public function deleteAction($id) {
        $kategori_tenant = KategoriTenant::where('id', $id)->first();
        if (!$kategori_tenant) {
            return redirect('/master-kategori-tenant')->with('danger', 'Data Master Kategori Tenant dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            KategoriTenant::where('id', $id)->delete();

            return redirect('/master-kategori-tenant')->with('success', 'Data Master Kategori Tenant dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
