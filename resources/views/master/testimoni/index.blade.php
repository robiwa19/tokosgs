@extends('layouts.app')
@section('title', 'Master Testimoni')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-12">
                    <button onclick="ajax_modal('Tambah Master Testimoni','{{ url('/master-testimoni/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($testimonis as $testimoni)
                            <tr>
                                <td>{{ $testimoni->id }}</td>
                                <td>{{ $testimoni->name }}</td>
                                <td>
                                    <button onclick="ajax_modal('Ubah Master Testimoni', '{{ url('master-testimoni/update/' . $testimoni->id) }}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="ajax_modal('Hapus Master Testimoni', '{{ url('master-testimoni/delete/' . $testimoni->id) }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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