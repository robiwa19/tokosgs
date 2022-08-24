@extends('layouts.app')
@section('title', 'Master Tenant')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-12">
                    <button onclick="ajax_modal('Tambah Master Tenant','{{ url('/master-tenant/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Kode Tenant</th>
                            <th>Nama Pemilik</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/master-tenant') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'kode_tenant', name: 'kode_tenant'},
            {data: 'nama_pemilik', name: 'nama_pemilik'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endsection