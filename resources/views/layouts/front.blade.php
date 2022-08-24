<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport" />
    <meta name="csrf-token" content="AyrQbdyyh2d3ZPJcBFYAwD7v5LP9GktqrfKAlFDm">

	  <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

	  <style>
      :root {
        --color-1st: #FF324D;
        --color-2nd: #1D2224;
        --primary-font: 'Poppins', sans-serif;
      }

      .cut-text {
        text-overflow: ellipsis;
        overflow: hidden;
        width: 160px;
        height: 1.2em;
        white-space: nowrap;
      }
    </style>

    <link rel="shortcut icon" href="{{ asset('/upload/general/favicon.png') }}">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="{{ env('APP_NAME') }}">
    <meta property="og:description" content="">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="article">
    <meta name="twitter:title" content="Shopwise - Laravel Ecommerce system">
    <meta name="twitter:description" content="">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/animate.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/bootstrap/css/bootstrap.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/ionicons.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/themify-icons.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/linearicons.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/flaticon.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/simple-line-icons.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/plugins/owlcarousel/css/owl.carousel.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/plugins/owlcarousel/css/owl.theme.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/plugins/owlcarousel/css/owl.theme.default.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/plugins/slick/slick-theme.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/plugins/slick/slick.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/magnific-popup.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/themes/shopwise/css/style.css') }}?v=1.15.5">
    <script src="{{ asset('/themes/shopwise/js/jquery-3.6.0.min.js') }}"></script>
    <link rel="alternate" href="{{ url('/') }}/vi" hreflang="vi" />
  </head>
  <body>
    <div id="alert-container"></div>
    <div data-session-domain="localhost"></div>

    <!-- START HEADER -->
    <header class="header_wrap  fixed-top header_with_topbar ">
      <div class="top-header d-none d-md-block">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <div class="language-wrapper choose-currency mr-3">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-select-language" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> IDR <span class="language-caret"></span>
                    </button>
                    <ul class="dropdown-menu language_bar_chooser">
                      <li>
                        <a href="javascript:void(0);" class="active">
                          <span>IDR</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <ul class="contact_detail text-center text-lg-left">
                  <li>
                    <i class="ti-mobile"></i>
                    <span>{{ SGSConfig::get('telepon') }}</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                <ul class="header_list">
                  @if (!Session::has('tenant_user'))
                  <li>
                    <a href="{{ url('/fo/register') }}" class="btn btn-sm" style="background-color: #FF324D; color: white;">
                      <span>Daftar</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/fo/login') }}">
                      <i class="ti-user"></i>
                      <span>Masuk</span>
                    </a>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="middle-header dark_skin">
        <div class="container">
          <div class="nav_block">
            <a class="navbar-brand" href="{{ url('/') }}">
              <img class="logo_dark" src="{{ asset((App\Models\Config::where('id', 1)->first())->logo ?? null) }}" alt="{{ env('APP_NAME') }}" />
            </a>
            <div class="contact_phone order-md-last">
              <i class="linearicons-phone-wave"></i>
              <span>{{ SGSConfig::get('telepon') }}</span>
            </div>
            <div class="product_search_form">
              <form action="{{ url('/') }}" method="GET">
                <div class="input-group">
                  <input class="form-control" name="q" value="" placeholder="Cari Produk..." required type="text">
                  <button type="submit" class="search_btn">
                    <i class="linearicons-magnifier"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom_header light_skin main_menu_uppercase bg_dark  mb-4 ">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-4">
              <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset((App\Models\Config::where('id', 1)->first())->logo ?? null) }}" alt="{{ env('APP_NAME') }}" />
              </a>
              <div class="categories_wrap">
                <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false" class="categories_btn">
                  <i class="linearicons-menu"></i><span>Kategori Tenant </span>
                </button>
                <div id="navCatContent" class=" navbar collapse">
                  <ul>
                    @php $count_kt = 1; @endphp
                    @foreach (App\Models\KategoriTenant::all() as $kt)
                    @php
                    if ($count_kt++ > 8) break;
                      $url_kt = url('/fo/kategori/' . $kt->id);
                      if (App\Models\KategoriTenant::where('id_induk_kategori', $kt->id)->count() >= 1) {
                        $url_kt = 'javascript:void(0);';
                      }
                    @endphp
                    @if ($kt->level == 1)
                      @if (App\Models\KategoriTenant::where('id_induk_kategori', $kt->id)->count() >= 1)
                      <li class="dropdown dropdown-mega-menu">
                        <a class="dropdown-item nav-link  dropdown-toggler " href="{{ $url_kt }}" data-toggle="dropdown">
                          <i class="{{ $kt->icon }}"></i>
                          <span>{{ $kt->nama_kategori }}</span>
                        </a>
                      @else
                      <li>
                        <a class="dropdown-item nav-link" href="{{ $url_kt }}">
                          <i class="{{ $kt->icon }}"></i>
                          <span>{{ $kt->nama_kategori }}</span>
                        </a>
                      @endif
                        @if (App\Models\KategoriTenant::where('id_induk_kategori', $kt->id)->count() >= 1)
                          <div class="dropdown-menu">
                            <ul class="mega-menu d-lg-flex">
                              <li class="mega-menu-col">
                                <ul>
                                  @foreach (App\Models\KategoriTenant::where('id_induk_kategori', $kt->id)->get() as $ik)
                                  <li>
                                    <a class="dropdown-item nav-link nav_item" href="{{ url('/fo/kategori/' . $ik->id) }}">{{ $ik->nama_kategori }}</a>
                                  </li>
                                  @endforeach
                                </ul>
                              </li>
                            </ul>
                          </div>
                        @endif
                      </li>
                    @endif
                    @endforeach
                  </ul>
                  <div class="more_categories">
                    <a href="{{ url('/fo/kategori') }}">Tampilkan Seluruh Kategori</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-6 col-8">
              <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
                  <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                  <ul class="navbar-nav">
                    <li class="active">
                      <a class="nav-link nav_item" href="{{ url('/fo') }}">Beranda</a>
                    </li>
                    <li class="dropdownn">
                      <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-toggle="dropdown">Lainnya</a>
                      <div class="dropdown-menu dropdown-reverse">
                        <ul>
                          <li>
                            <a href="{{ url('/fo/pages/about_us') }}" class="dropdown-item menu-link"> About Us </a>
                          </li>
                          <li>
                            <a href="{{ url('/fo/pages/toc') }}" class="dropdown-item menu-link"> Terms Of Conditions </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                  <li>
                    <a href=" {{ url('/fo') }}" class="nav-link">
                      <i class="linearicons-user"></i>
                    </a>
                  </li>
                  <li class="dropdown cart_dropdown">
                    <a class="nav-link cart_trigger btn-shopping-cart" href="javascript:void(0);" data-toggle="dropdown">
                      <i class="linearicons-cart"></i>
                      <span class="cart_count">0</span>
                    </a>
                    <div class="cart_box dropdown-menu dropdown-menu-right">
                      <p class="text-center">Keranjang belanja Anda kosong!</p>
                    </div>
                  </li>
                </ul>
                <div class="pr_search_icon">
                  <a href="javascript:void(0);" class="nav-link pr_search_trigger">
                    <i class="linearicons-magnifier"></i>
                  </a>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END HEADER -->
    @yield('header')
    <div id="app">
      @yield('content')
    </div>
    <footer class="footer_dark">
      <div class="footer_top">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="widget">
                <div class="footer_logo">
                  <a href="{{ url('/') }}">
                    {{--  <img src="{{ asset('/upload/general/logo-light.png') }}" alt="Shopwise - Laravel Ecommerce system" />  --}}
                  </a>
                </div>
                <p></p>
              </div>
              <div class="widget">
                <ul class="social_icons social_white">
                  <li>
                    <a href="https://facebook.com" class="sc_facebook" target="_blank">
                      <i class="ion-social-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com" class="sc_twitter" target="_blank">
                      <i class="ion-social-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://youtube.com" class="sc_youtube" target="_blank">
                      <i class="ion-social-youtube-outline"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://instagram.com" class="sc_instagram" target="_blank">
                      <i class="ion-social-instagram-outline"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <div class="widget">
                <h6 class="widget_title">Link Terkait</h6>
                <ul class="widget_links">
                  <li>
                    <a href="{{ url('/') }}/about-us">
                      <span>Tentang Kami</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/faq">
                      <span>FAQ</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/location">
                      <span>Lokasi</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/affiliates">
                      <span>Affiliasi</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/contact-us">
                      <span>Kontak</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            {{--  <div class="col-lg-2 col-md-4 col-sm-6">
              <div class="widget">
                <h6 class="widget_title">Kategori</h6>
                <ul class="widget_links">
                  <li>
                    <a href="{{ url('/') }}/product-categories/television">
                      <span>Television</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/product-categories/home-audio-theaters">
                      <span>Mobile</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/product-categories/tv-videos">
                      <span>Headphone</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/product-categories/camera-photos-videos">
                      <span>Watches</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/product-categories/cellphones-accessories">
                      <span>Game</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>  --}}
            <div class="col-lg-2 col-md-4 col-sm-6">
              <div class="widget">
                <h6 class="widget_title">Akun Resmi</h6>
                <ul class="widget_links">
                  <li>
                    <a href="{{ url('/') }}/customer/overview">
                      <span>Profil Kami</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/wishlist">
                      <span>Wishlist</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/customer/orders">
                      <span>Penjualan</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/') }}/orders/tracking">
                      <span>Lacak Pembelian</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="widget">
                <h6 class="widget_title">Info Kontak</h6>
                <ul class="contact_info contact_info_light">
                  <li>
                    <i class="ti-location-pin"></i>
                    <p>{{ SGSConfig::get('alamat') }}</p>
                  </li>
                  <li>
                    <i class="ti-email"></i>
                    <a href="mailto:{{ SGSConfig::get('email') }}">{{ SGSConfig::get('email') }}</a>
                  </li>
                  <li>
                    <i class="ti-mobile"></i>
                    <p>{{ SGSConfig::get('telepon') }}</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom_footer border-top-tran">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p class="mb-md-0 text-center text-md-left">Copyright &copy; 2022 {{ env('APP_NAME') }}. All Rights Reserved.</p>
            </div>
            <div class="col-md-6">
              <ul class="footer_payment text-center text-lg-right">
                <li>
                  <img src="{{ asset('/upload/general/visa.png') }}" alt="payment method">
                </li>
                <li>
                  <img src="{{ asset('/upload/general/paypal.png') }}" alt="payment method">
                </li>
                <li>
                  <img src="{{ asset('/upload/general/master-card.png') }}" alt="payment method">
                </li>
                <li>
                  <img src="{{ asset('/upload/general/discover.png') }}" alt="payment method">
                </li>
                <li>
                  <img src="{{ asset('/upload/general/american-express.png') }}" alt="payment method">
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <div id="remove-item-modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus seluruh Keranjang Belanja Anda?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-fill-out" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-fill-line confirm-remove-item-carts">Yakin!</button>
          </div>
        </div>
      </div>
    </div>
    <a href="javascript:void(0);" class="scrollup" style="display: none;">
      <i class="ion-ios-arrow-up"></i>
    </a>
    <script>
      window.trans = {
        "No reviews!": "No reviews!",
        "Days": "Days",
        "Hours": "Hours",
        "Minutes": "Minutes",
        "Seconds": "Seconds",
      }
      window.siteUrl = "{{ url('/') }}";
    </script>
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/vendor/core/plugins/simple-slider/libraries/owl-carousel/owl.carousel.css') }}?v=1.0.1">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/vendor/core/plugins/simple-slider/css/simple-slider.css') }}?v=1.0.1">
    <script src="{{ asset('/themes/shopwise/plugins/slick/slick.min.js') }}"></script>
    {{-- <script src="{{ asset('/vendor/core/plugins/language/js/language-public.js') }}?v=1.0.0"></script> --}}
    <script src="{{ asset('/themes/shopwise/js/popper.min.js') }}"></script>
    <script src="{{ asset('/themes/shopwise/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/themes/shopwise/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/themes/shopwise/js/waypoints.min.js') }}?v=4.0.1"></script>
    <script src="{{ asset('/themes/shopwise/plugins/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/themes/shopwise/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('/themes/shopwise/js/scripts.js') }}?v=1.15.5"></script>
    <script src="{{ asset('/themes/shopwise/js/backend.js') }}?v=1.15.5"></script>
    {{-- <script src="{{ asset('/vendor/core/plugins/ecommerce/js/change-product-swatches.js') }}"></script> --}}
    <script src="{{ asset('/themes/shopwise/js/jquery.countdown.min.js') }}"></script>
    {{-- <script src="{{ asset('/vendor/core/plugins/simple-slider/libraries/owl-carousel/owl.carousel.js') }}?v=1.0.1"></script>
    <script src="{{ asset('/vendor/core/plugins/simple-slider/js/simple-slider.js') }}?v=1.0.1"></script> --}}
    {{-- <script src="{{ asset('/themes/shopwise/js/app.js') }}?v=1.15.5"></script> --}}
    <script>
      function alert_container(type, message) {
        $('#alert-container').html(`
          <div class="alert alert-${type} alert-dismissible">
            <span class="close ion-close" data-dismiss="alert" aria-label="close"></span>
            <strong>${message}</strong>
          </div>
        `);

        setTimeout(function () {
          $('#alert-container').html("");
        }, 3000);
      }

      function ajax_add_cart(id) {
        $.ajax({
          url: "{{ url('/fo/ajax/produk_detail') }}",
          method: "GET",
          data: {
            id: id
          },
          dataType: "JSON",
          success: function (res) {
            var carts = JSON.parse(window.sessionStorage.getItem('carts')) || [];
            carts[carts.length] = res;
            window.sessionStorage.setItem('carts', JSON.stringify(carts));
            
            var html = `<ul class="cart_list">`;
            for (var i = 0; i < carts.length; i++) {
              html += `<li>
                <a href="javascript:void(0);" class="item_remove remove-cart-button">
                  <i class="ion-close"></i>
                </a>
                <a href="{{ url('/fo/produk') }}/${carts[i].id}">
                  <img src="${carts[i].image_path_file}" alt="${carts[i].nama_produk}">
                  ${carts[i].nama_produk}
                </a>
                <span class="cart_quantity">
                  <span class="cart_amount">Rp ${carts[i].harga_format}</span>
                </span>
              </li>`;
            }
            html += `</ul>
            <div class="cart_footer">
              <p class="cart_buttons">
                <a href="{{ url('/fo/carts') }}" class="btn btn-fill-out btn-block">Checkout</a>
              </p>
            </div>`;
            $('.cart_box').html(html);
            $('.cart_count').html(carts.length);

            alert_container('success', 'Produk berhasil ditambahkan ke keranjang.');
          },
          error: function () {
            alert_container('danger', 'Produk gagal ditambahkan ke keranjang.');
          }
        })
      }

      $(window).ready(function () {
        $.format_rupiah = function (money) {
          return new Intl.NumberFormat('id-ID',
            { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
          ).format(money);
        }

        var carts = JSON.parse(window.sessionStorage.getItem('carts')) ?? [];
        if (carts.length >= 1) {
          var html = `<ul class="cart_list">`;
          for (var i = 0; i < carts.length; i++) {
            html += `<li>
              <a href="javascript:void(0);" class="item_remove remove-cart-button">
                <i class="ion-close"></i>
              </a>
              <a href="{{ url('/fo/produk') }}/${carts[i].id}">
                <img src="${carts[i].image_path_file}" alt="${carts[i].nama_produk}">
                ${carts[i].nama_produk}
              </a>
              <span class="cart_quantity">
                <span class="cart_amount">Rp ${carts[i].harga_format}</span>
              </span>
            </li>`;
          }
          html += `</ul>
          <div class="cart_footer">
            <p class="cart_buttons">
              <a href="{{ url('/fo/carts') }}" class="btn btn-fill-out btn-block">Checkout</a>
            </p>
          </div>`;
          $('.cart_box').html(html);
          $('.cart_count').html(carts.length);
        }

        $('.ajax-produk-foto').each(function () {
          const data = $(this);
          var imgUrl = data.attr('data-lazy-src');
    
          $.ajax({
            url: imgUrl,
            success: function (res) {
              data.attr('src', imgUrl);
            }
          });
        });

        $('.confirm-remove-item-carts').click(function () {
          window.sessionStorage.removeItem('carts');
          $('#remove-item-modal').modal('hide');
          $('.cart_box').html('<p class="text-center">Keranjang belanja Anda kosong!</p>');
          $('.cart_count').html(carts.length);
          window.location.reload();
        });
      }); 
    </script>
    @yield('script')
  </body>
</html>
