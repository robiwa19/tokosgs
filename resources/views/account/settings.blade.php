@extends('layouts.app')
@section('title', 'Pengaturan Akun')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Ubah Kata Sandi</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/account/change_password') }}" method="post" class="row">
                    @CSRF
                    <div class="form-group col-12">
                        <label>Kata Sandi Lama</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label>Kata Sandi Baru</label>
                        <input type="password" name="newpassword" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label>Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="confirm_newpassword" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection