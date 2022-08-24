@extends('layouts.front')
@section('title', 'Halaman Utama')

@section('content')
  <div>
    <div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div id="carouselExampleControls" class="carousel slide light_arrow" data-ride="carousel">
              <div class="carousel-inner">
                @php $i = 0; @endphp
                @foreach ($sliders as $slider)
                @php $index = $i++; @endphp
                <div class="carousel-item {{ $index+1 == 1 ? 'active' : '' }} background_bg" data-img-src="{{ asset($slider->image_path) }}">
                  <div class="banner_slide_content banner_content_inner">
                    <div class="col-lg-8 col-10">
                      <div class="banner_content overflow-hidden">
                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">{{ $slider->note }}</h5>
                        <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ $slider->title }}</h2>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <ol class="carousel-indicators indicators_style1">
                @php $i = 0; @endphp
                @foreach ($sliders as $slider)
                @php $index = $i++; @endphp
                <li data-target="#carouselExampleControls" data-slide-to="{{ $index }}" {!! $index+1 == 1 ? 'class="active"' : '' !!}></li>
                @endforeach
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <!-- START SECTION SHOP -->
    <div class="section small_pt small_pb">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading_tab_header">
              <div class="heading_s2">
                <h4>Produk Unggulan Solo Great Sale</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
              @foreach ($produks as $produk)
              <div class="item">
                <div class="product_wrap">
                  <div class="product_img">
                    <a href="{{ url('fo/produk/' . $produk->id) }}">
                      @if (count($produk->foto($produk->id)) == 0)
                        <img src="https://dummyimage.com/540x600/bfbdbf/fff.jpg" alt="{{ $produk->nama_produk }}">
                      @else
                        @foreach ($produk->foto($produk->id) as $foto)
                          <img class="ajax-produk-foto" src="https://dummyimage.com/540x600/bfbdbf/fff.jpg" data-lazy-src="{{ asset($foto->path_file) }}" alt="{{ $produk->nama_produk }}">
                          @php break; @endphp
                        @endforeach
                      @endif
                    </a>
                    <div class="product_action_box">
                      <ul class="list_none pr_action_btn">
                        <li class="add-to-cart">
                          <a class="add-to-cart-button" href="javascript:void(0);" onclick="ajax_add_cart('{{ $produk->id }}')">
                            <i class="icon-basket-loaded"></i> Keranjang
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="product_info">
                    <h6 class="product_title">
                      <a href="{{ url('/fo/produk/' . $produk->id) }}">{{ $produk->nama_produk }}</a>
                    </h6>
                    <div class="product_price">
                      <span class="price">Rp {{ number_format($produk->harga,0,',','.') }}</span>
                    </div>
                    <div class="pr_desc">
                      <p>{{ $produk->deskripsi }}</p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END SECTION SHOP -->
  </div>
  <div>
    <!-- START SECTION BLOG -->
    <div class="section pb_20">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="heading_s1 text-center">
              <h2>Berita & Informasi Terkini</h2>
            </div>
          </div>
        </div>
        <div class="justify-content-center">
            <div class="row">
                @php $i = 1; @endphp
                @foreach ($news as $new)
                @php
                  if ($i++ > 3) break;
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style2 box_shadow1">
                        <div class="blog_img">
                            <a href="{{ 'https://sologreatsale.com/activities/' . $new['slug'] }}">
                                <img src="{{ $new['image']['image'] ?? null }}" alt="{{ $new['name'] }}"/>
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title">
                                    <a href="{{ 'https://sologreatsale.com/activities/' . $new['slug'] }}">{{ $new['name'] }}</a>
                                </h5>
                                <ul class="list_none blog_meta">
                                    <li><i class="ti-calendar"></i> {{ $new['updated_at'] }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
      </div>
    </div>
    <!-- END SECTION BLOG -->
  </div>
  <div>
    <!-- START SECTION TESTIMONIAL -->
    <div class="section bg_redon">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="heading_s1 text-center">
              <h2>Testimoni Konsumen</h2>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div data-nav="true" data-dots="false" data-center="true" data-loop="false" data-autoplay="true" data-items="1" class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2 owl-loaded owl-drag">
              <div class="owl-stage-outer">
                <div class="owl-stage" style="transition: all 0.25s ease 0s; width: 2280px; transform: translate3d(-1710px, 0px, 0px);">
                  @foreach ($testimonis as $testimoni)
                  <div class="owl-item">
                    <div class="testimonial_box">
                      <div class="testimonial_desc">
                        <p>{{ $testimoni->data }}</p>
                      </div>
                      <div class="author_wrap">
                        <div class="author_img">
                          <img src="{{ asset($testimoni->profile) }}" alt="{{ $testimoni->name }}">
                        </div>
                        <div class="author_name">
                          <h6>{{ $testimoni->name }}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="owl-nav">
                <button type="button" role="presentation" class="owl-prev">
                  <i class="ion-ios-arrow-left"></i>
                </button>
                <button type="button" role="presentation" class="owl-next disabled">
                  <i class="ion-ios-arrow-right"></i>
                </button>
              </div>
              <div class="owl-dots disabled"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END SECTION TESTIMONIAL -->
  </div>
  <!-- <div>
    <div class="section">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-md-4">
            <div class="icon_box icon_box_style1">
              <div class="icon">
                <i class="flaticon-shipped"></i>
              </div>
              <div class="icon_box_content">
                <h5>Free Delivery</h5>
                <p>Free shipping on all US order or order above $200</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="icon_box icon_box_style1">
              <div class="icon">
                <i class="flaticon-money-back"></i>
              </div>
              <div class="icon_box_content">
                <h5>30 Day Returns Guarantee</h5>
                <p>Simply return it within 30 days for an exchange</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="icon_box icon_box_style1">
              <div class="icon">
                <i class="flaticon-support"></i>
              </div>
              <div class="icon_box_content">
                <h5>27/4 Online Support</h5>
                <p>Contact us 24 hours a day, 7 days a week</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <div>
    <!-- START SECTION SPONSOR -->
    <div class="section small_pt">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="heading_tab_header">
              <div class="heading_s2">
                <h2>Sponsor Kami</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="5" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "3"}, "480":{"items": "4"}, "767":{"items": "5"}, "991":{"items": "6"}}'>
              @foreach ($sponsors as $sponsor)
              <div class="item">
                <div class="cl_logo">
                  <img src="{{ $sponsor['image'] }}" alt="{{ $sponsor['name'] }}" style="max-width: 75px;" />
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END SECTION SPONSOR -->
  </div>
  <div>
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <div class="section bg_default small_pt small_pb">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="newsletter_text text_white">
              <h3>Join Our Newsletter Now</h3>
              <p>Register now to get updates on promotions.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="newsletter_form2 rounded_input newsletter-form">
              <form method="post" action="{{ url('/') }}/newsletter/subscribe">
                <input type="hidden" name="_token" value="AyrQbdyyh2d3ZPJcBFYAwD7v5LP9GktqrfKAlFDm">
                <input name="email" type="email" class="form-control" placeholder="Enter Your Email">
                <button type="submit" class="btn btn-dark btn-radius">Subscribe</button>
              </form>
              <div class="newsletter-message newsletter-success-message" style="display: none"></div>
              <div class="newsletter-message newsletter-error-message" style="display: none"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection