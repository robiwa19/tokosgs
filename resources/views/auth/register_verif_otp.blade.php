<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ env('APP_NAME') }} | Verifikasi Email</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}?v=3.2.0">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo"> <a href="javascript:void(0);"><b>{{ env('APP_NAME') }}</b></a> | Verifikasi Email</div>
		<div class="card card-outline card-primary">
			<div class="card-body login-card-body">
                @if (Session::has('danger'))
                <div class="alert alert-danger fade show mb-2">
                    <button class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ Session::get('danger') }}</strong>
                </div>
                @endif

                @if (Session::has('success'))
                <div class="alert alert-success fade show mb-2">
                    <button class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
                @endif
				<form action="{{ url('/auth/register_verif_otp/' . $user->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukkan Kode OTP" name="otp">
                            <div class="input-group-append">
                                <div class="input-group-text"> <span class="fas fa-key"></span> </div>
                            </div>
                        </div>
                        @error('otp')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
					<div class="row">
						<div class="col-4 offset-8">
							<button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('dist/js/adminlte.min.js') }}?v=3.2.0"></script>
</body>

</html>