@extends('layouts.app')
@section('title', 'Master Config')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                {{--  <div class="col-md-12">
                    <button onclick="ajax_modal('Tambah Master Config','{{ url('/master-config/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>  --}}
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Tahun</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Maskimal Hari</th>
                            <th>Harga/Poin</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($configs as $config)
                            <tr>
                                <td>{{ $config->id }}</td>
                                <td>{{ $config->tahun }}</td>
                                <td>{{ $config->tgl_awal }}</td>
                                <td>{{ $config->tgl_akhir }}</td>
                                <td>{{ $config->maksimal_hari }}</td>
                                <td>Rp {{ number_format($config->harga_per_poin,0,',','.') }}</td>
                                <td>
                                    <button onclick="ajax_modal('Ubah Master Config', '{{ url('master-config/update/' . $config->id) }}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="ajax_modal('Hapus Master Config', '{{ url('master-config/delete/' . $config->id) }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
