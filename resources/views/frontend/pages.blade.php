@extends('layouts.front')
@php $title = App\Models\Konten::getCodeName($konten->code); @endphp
@section('title', $title)

@section('header')
<div class="breadcrumb_section bg_gray page-title-mini" style="margin-top: -25px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{ $title }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/fo') }}" title="Home">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="section" style="margin-bottom: 250px;;">
    <div class="container">
        <p>{!! $konten->data !!}</p>
    </div>
</div>
@endsection