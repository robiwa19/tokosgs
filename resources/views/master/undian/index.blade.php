@extends('layouts.app')
@section('title', 'Master Undian')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-12">
                    <button onclick="ajax_modal('Tambah Master Undian','{{ url('/master-undian/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Tahun</th>
                            <th>ID Peringkat</th>
                            <th>Keterangan Hadiah</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($undians as $undian)
                            <tr>
                                <td>{{ $undian->id }}</td>
                                <td>{{ $undian->tahun }}</td>
                                <td>{{ $undian->id_peringkat }}</td>
                                <td>{{ $undian->keterangan_hadiah }}</td>
                                <td>{{ $undian->jumlah }}</td>
                                <td>
                                    <button onclick="ajax_modal('Ubah Master Undian', '{{ url('master-undian/update/' . $undian->id) }}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="ajax_modal('Hapus Master Undian', '{{ url('master-undian/delete/' . $undian->id) }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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