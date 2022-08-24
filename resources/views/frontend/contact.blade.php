@extends('layouts.front')
@section('title', 'Hubungi Kami')

@section('header')
<div class="breadcrumb_section bg_gray page-title-mini" style="margin-top: -25px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Hubungi Kami</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/fo') }}" title="Home">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Hubungi Kami</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="section" style="margin-bottom: 250px;;">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-map2"></i>
                    </div>
                    <div class="contact_text">
                        <span>Alamat</span>
                        <p>{{ SGSConfig::get('alamat') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-envelope-open"></i>
                    </div>
                    <div class="contact_text">
                        <span>Email</span>
                        <a href="mailto:{{ SGSConfig::get('email') }}">{{ SGSConfig::get('email') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-tablet2"></i>
                    </div>
                    <div class="contact_text">
                        <span>Telepon</span>
                        <p>{{ SGSConfig::get('telepon') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection