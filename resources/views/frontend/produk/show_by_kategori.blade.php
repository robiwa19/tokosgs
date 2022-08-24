@extends('layouts.front')
@section('title', $kategori->nama_kategori)

@section('header')
<div class="breadcrumb_section bg_gray page-title-mini" style="margin-top: -25px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{ $kategori->nama_kategori }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/fo') }}" title="Home">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $kategori->nama_kategori }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="row shop_container grid">
                    @foreach ($produks as $produk)
                        <div class="col-md-4 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="{{ url('/fo/produk/' . $produk->id) }}">
                                        @if (count($produk->foto($produk->id)) == 0)
                                            <img src="https://dummyimage.com/540x600/bfbdbf/fff.jpg" alt="{{ $produk->nama_produk }}">
                                        @else
                                            @foreach ($produk->foto($produk->id) as $foto)
                                                <img class="ajax-produk-foto" src="https://dummyimage.com/540x600/bfbdbf/fff.jpg" data-lazy-src="{{ asset($foto->path_file) }}" alt="{{ $produk->nama_produk }}">
                                                @php break; @endphp
                                            @endforeach
                                        @endif
                                    </a>
                                </div>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart">
                                            <a class="add-to-cart-button" href="javascript:void(0);" onclick="ajax_add_cart('{{ $produk->id }}')">
                                                <i class="icon-basket-loaded"></i> Keranjang
                                            </a>
                                        </li>
                                    </ul>
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
            <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                <div class="sidebar">
                    <div class="widget">
                        <h5 class="widget_title">Kategori</h5>
                        <ul class="ps-list--categories">
                            @foreach ($kategoris as $data)
                                @if ($data->id_induk_kategori == null && KategoriTenant::where('id_induk_kategori', $data->id)->count() >= 1)
                                    <li class="menu-item-has-children {{ ($data->id == $kategori->id_induk_kategori) ? 'current-menu-item' : '' }}">
                                        <a href="javascript:void(0);">{{ $data->nama_kategori }}</a>
                                        <span class="sub-toggle"><i class="icon-angle"></i></span>
                                        <ul class="sub-menu">
                                            @foreach (KategoriTenant::getInduk($data->id) as $kt)
                                                <li style="{{ $kt->id == $kategori->id ? 'color: #FF324D;' : '' }}">
                                                    <a href="{{ url('/fo/kategori/' . $kt->id) }}">{{ $kt->nama_kategori }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif ($data->level == '1')
                                    <li class="{{ ($data->id == $kategori->id) ? 'current-menu-item' : '' }}">
                                        <a href="{{ url('/fo/kategori/' . $data->id) }}">{{ $data->nama_kategori }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection