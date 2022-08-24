<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}?v=3.2.0">
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    @if (Session::has('sgs_user'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/auth/logout') }}">
                            <i class="fas fa-power-off"></i>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
                </a>
                <div class="sidebar">
                    @if (Session::has('sgs_user'))
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('/dist/img/avatar.png') }}" class="img-circle elevation-2" style="width: 35px; height: 35px;" />
                        </div>
                        <div class="info">
                            <a href="javascript:void(0);" class="d-block">{{ User::auth()->name }}</a>
                        </div>
                    </div>
                    @endif
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            @if (Session::has('sgs_user'))
                                <li class="nav-item">
                                    <a href="{{ url('/account/settings') }}" class="nav-link"> <i class="nav-icon fas fa-user"></i>
                                        <p>Pengaturan Akun</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="nav-link"> <i class="nav-icon fas fa-home"></i>
                                        <p>Halaman Utama</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link"> <i class="nav-icon fas fa-th"></i>
                                        <p>
                                            Master
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/master-config') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Config</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-konten') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Konten</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-undian') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Undian</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-tenant') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Tenant</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-kategori-tenant') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Kategori Tenant</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-produk-tenant') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Produk Tenant</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-slider') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Slider</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/master-testimoni') }}" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                                <p>Testimoni</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('title')</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0);">{{ env('APP_NAME') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container-fluid">
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

                        @if ($errors->any())
                        <div class="alert alert-danger fade show mb-2">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Mohon periksa input kembali.</strong>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <div id="ajax-modal" class="modal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="ajax-modal-title" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="ajax-modal-body" class="modal-body"></div>
                </div>
            </div>
        </div>

        <script>
            function ajax_modal(title, url) {
                $('#ajax-modal-title').html(title);

                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "HTML",
                    success: function (res) {
                        $('#ajax-modal-body').html(res);
                        $('#ajax-modal').modal('show');
                    },
                    error: function () {
                        $('#ajax-modal-body').html('Gagal memuat konten.');
                        $('#ajax-modal').modal('show');
                    }
                });
            }

            function formatRupiah (money) {
                return new Intl.NumberFormat('id-ID',
                    { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
                ).format(money);
            }
        </script>

        <!-- Required JavaScript -->
        <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('/dist/js/adminlte.min.js') }}?v=3.2.0"></script>

        @yield('script')
    </body>
</html>
