@extends('layouts.app')
@section('title', 'Master Kategori Tenant')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-12">
                    <button onclick="ajax_modal('Tambah Master Kategori Tenant','{{ url('/master-kategori-tenant/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Icon</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($kategori_tenants as $kategori_tenant)
                            <tr>
                                <td>{{ $kategori_tenant->id }}</td>
                                <td>{{ $kategori_tenant->nama_kategori }}</td>
                                <td><i class="{{ $kategori_tenant->icon }}"></i></td>
                                <td>
                                    <button onclick="ajax_modal('Ubah Master Kategori Tenant', '{{ url('master-kategori-tenant/update/' . $kategori_tenant->id) }}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="ajax_modal('Hapus Master Kategori Tenant', '{{ url('master-kategori-tenant/delete/' . $kategori_tenant->id) }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#datatable').DataTable();
</script>
@endsection