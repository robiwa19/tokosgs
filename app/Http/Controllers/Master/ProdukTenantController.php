<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ProdukFotoTenant;
use App\Models\ProdukTenant;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdukTenantController extends Controller
{
    public function index(Request $r) {
        $tenants = Tenant::all();
        if ($r->has('id_tenant')) {
            $produk_tenants = ProdukTenant::where('id_tenant', $r->id_tenant)->get();

            return json_encode($produk_tenants);
        }

        return view('master.produk_tenant.index', compact('tenants'));
    }

    public function create() {
        $tenants = Tenant::all();

        return view('master.produk_tenant.create', compact('tenants'));
    }

    public function createAction(Request $r) {
        $r->validate([
            'id_tenant' => 'required|numeric',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $tenant = Tenant::where('id', $id)->first();
        if (!$tenant) {
            return redirect('/master-produk-tenant')->with('danger', 'Data Tenant tidak ditemukan.');
        }

        $image = $r->file('image');
        $upload_location = null;
        if ($image->isValid()) {
            $filename = Str::random(10) . '.' . $image->extension();
            $image->storeAs('public/images', $filename);
            $upload_location = '/storage/images/' . $filename;
        } else {
            return redirect('/master-produk-tenant')->with('danger', 'Gagal mengupload image.');
        }

        $produk_tenant = new ProdukTenant;
        $produk_tenant->id_tenant = $r->id_tenant;
        $produk_tenant->nama_produk = $r->nama_produk;
        $produk_tenant->deskripsi = $r->deskripsi;
        $produk_tenant->harga = $r->harga;
        $produk_tenant->created_by = User::auth()->id;
        $produk_tenant->save();

        $produk_foto_tenant = new ProdukFotoTenant;
        $produk_foto_tenant->id_tenant_produk = $produk_tenant->id;
        $produk_foto_tenant->path_file = $upload_location;
        $produk_foto_tenant->created_by = User::auth()->id;
        $produk_foto_tenant->save();

        return redirect('/master-produk-tenant')->with('success', 'Data Master Produk Tenant berhasil ditambahkan.');
    }

    public function update($id) {
        $tenants = Tenant::all();
        $produk_tenant = ProdukTenant::where('id', $id)->first();
        if (!$produk_tenant) {
            return redirect('/master-produk-tenant')->with('danger', 'Data Master Produk Tenant dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.produk_tenant.update', [
            'tenants' => $tenants,
            'produk_tenant' => $produk_tenant
        ]);
    }

    public function updateAction(Request $r, $id) {
        $produk_tenant = ProdukTenant::find($id);
        if (!$produk_tenant) {
            return redirect('/master-produk-tenant')->with('danger', 'Data Master Produk Tenant dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'id_tenant' => 'required|numeric',
                'nama_produk' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required|numeric'
            ]);

            if ($r->hasFile('image')) {
                $r->validate(['image' => 'mimes:jpeg,jpg,png']);

                $image = $r->file('image');
                if ($image->isValid()) {
                    $filename = Str::random(10) . '.' . $image->extension();
                    $image->storeAs('public/images', $filename);
                    $upload_location = '/storage/images/' . $filename;
                } else {
                    return redirect('/master-produk-tenant')->with('danger', 'Gagal mengupload image.');
                }
            }
            
            $produk_tenant->id_tenant = $r->id_tenant;
            $produk_tenant->nama_produk = $r->nama_produk;
            $produk_tenant->deskripsi = $r->deskripsi;
            $produk_tenant->harga = $r->harga;
            $produk_tenant->updated_by = User::auth()->id;
            $produk_tenant->save();

            if ($upload_location !== null) {
                $produk_foto_tenant = ProdukFotoTenant::find($id);
                $produk_foto_tenant->path_file = $upload_location;
                $produk_foto_tenant->updated_by = User::auth()->id;
                $produk_foto_tenant->save();
            }

            return redirect('/master-produk-tenant')->with('success', 'Data Master Produk Tenant dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $produk_tenant = ProdukTenant::where('id', $id)->first();
        if (!$produk_tenant) {
            return redirect('/master-produk-tenant')->with('danger', 'Data Master Produk Tenant dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.produk_tenant.delete', compact('produk_tenant'));
    }

    public function deleteAction($id) {
        $produk_tenant = ProdukTenant::where('id', $id)->first();
        if (!$produk_tenant) {
            return redirect('/master-produk-tenant')->with('danger', 'Data Master Produk Tenant dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            ProdukTenant::where('id', $id)->delete();

            return redirect('/master-produk-tenant')->with('success', 'Data Master Produk Tenant dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
