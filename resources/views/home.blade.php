@extends('layouts.app')
@section('title', 'Halaman Utama')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Halo <b>{{ User::auth()->name }}</b>!</h1>
    </div>
</div>
@endsection