@extends('layouts.app')
@section('title', 'Master Produk Tenant')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-6">
                    <button onclick="ajax_modal('Tambah Master Produk Tenant','{{ url('/master-produk-tenant/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="id_tenant" id="tenant" class="form-control select2">
                            <option value="" selected disabled>Pilih Tenant</option>
                            @foreach ($tenants as $tenant)
                            <option value="{{ $tenant->id }}">{{ $tenant->nama_pemilik }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody id="tablebody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.select2').select2();
    $('#datatable').DataTable();

    $('#tenant').change(function () {
        var id_tenant = $(this).val();
        $.ajax({
            url: `{{ url('/master-produk-tenant') }}`,
            method: "GET",
            data: {
                id_tenant: id_tenant
            },
            dataType: "JSON",
            success: function (res) {
                var tabledata = "";
                for (let i = 0; i < res.length; i++) {
                    tabledata += '<tr>';
                        tabledata += `<td>${i+1}</td>`;
                        tabledata += `<td>${res[i].nama_produk}</td>`;
                        tabledata += `<td>${res[i].deskripsi}</td>`;
                        tabledata += `<td>${formatRupiah(res[i].harga)}</td>`;
                        tabledata += '<td>';
                            tabledata += `<button onclick="ajax_modal('Ubah Produk Tenant', '{{ url('/master-produk-tenant/update') }}/${res[i].id}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>`;
                            tabledata += `<button onclick="ajax_modal('Hapus Produk Tenant', '{{ url('/master-produk-tenant/delete') }}/${res[i].id}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>`;
                        tabledata += '</td>';
                    tabledata += '</tr>';
                }

                $('#datatable').DataTable().destroy();
                $('#tablebody').html(tabledata);
                $('#datatable').DataTable();
            }
        });
    });
</script>
@endsection