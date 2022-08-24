@extends('layouts.front')
@section('title', $title ?? 'Seluruh Kategori')

@section('content')
<div class="section" style="margin-bottom: 250px;;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($kategoris as $kategori)
                    @if (App\Models\KategoriTenant::where('id_induk_kategori', $kategori->id)->count() >= 1)
                        <ul class="list-group w-100">
                            <a href="{{ url('fo/kategori/' . $kategori->id . '/induk') }}" class="list-group-item">
                                <i class="{{ $kategori->icon }}"></i>
                                <span>{{ $kategori->nama_kategori }}</span>
                            </a>
                        </ul>
                    @else
                        <ul class="list-group w-100">
                            <a href="{{ url('fo/kategori/' . $kategori->id) }}" class="list-group-item">
                                <i class="{{ $kategori->icon }}"></i>
                                <span>{{ $kategori->nama_kategori }}</span>
                            </a>
                        </ul>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection