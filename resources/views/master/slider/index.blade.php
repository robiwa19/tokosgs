@extends('layouts.app')
@section('title', 'Master slider')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-12">
                    <button onclick="ajax_modal('Tambah Master Slider','{{ url('/master-slider/create') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
                <div class="table-responsive col-md-12">
                    <table id="datatable" class="table table-bordered mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td><img src="{{ asset($slider->image_path) }}" alt="{{ $slider->title }}" style="max-width: 100px;"></td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->note }}</td>
                                <td>
                                    <button onclick="ajax_modal('Ubah Master Slider', '{{ url('master-slider/update/' . $slider->id) }}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="ajax_modal('Hapus Master Slider', '{{ url('master-slider/delete/' . $slider->id) }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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