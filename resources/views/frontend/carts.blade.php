@extends('layouts.front')
@section('title', 'Keranjang Belanja')

@section('header')
<div class="breadcrumb_section bg_gray page-title-mini" style="margin-top: -25px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Keranjang Belanja</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/fo') }}" title="Home">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Keranjang Belanja</li>
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
            <div class="col-md-12">
                <div class="table-responsive shop_cart_table">
                    <table class="table">
                        <thead>
                            <th>Gambar</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Hapus</th>
                        </thead>
                        <tbody id="keranjang-belanja"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="divider center_icon mt-5 mb-5"><i class="ti-shopping-cart-full"></i></div>
        <div class="row">
            <div class="col-md-12">
                <div class="border p-3 p-md-4">
                    <div class="table-responsive mb-0">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">Total</td>
                                    <td class="cart_total_amount"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button id="checkout" class="btn btn-fill-out btn-block">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        let amounts = 0;
        var carts = JSON.parse(window.sessionStorage.getItem('carts')) ?? [];
        if (carts.length >= 1) {
            var html = '';
            for (var i = 0; i < carts.length; i++) {
                amounts = amounts+carts[i].harga;
                html += `<tr>
                    <td>
                        <img src="${carts[i].image_path_file}" alt="${carts[i].nama_produk}" style="width: 100px; height: 100px;">
                    </td>
                    <td>${carts[i].nama_produk}</td>
                    <td>Rp ${carts[i].harga_format}</td>
                    <td>
                        <button class="btn btn-danger btn-sm hapus-keranjang" data-i="${i}"><i class="ion-close"></i></button>
                    </td>
                </tr>`;
            }
            $('#keranjang-belanja').html(html);
        }

        $('.cart_total_amount').html($.format_rupiah(amounts));

        $('.hapus-keranjang').click(function () {
            var i = $(this).attr('data-i');
            var carts = JSON.parse(window.sessionStorage.getItem('carts')) ?? [];
            for (var key in carts) {
                if (key == i) {
                    carts.splice(key, 1);
                }
            }

            window.sessionStorage.setItem('carts', JSON.stringify(carts));
            window.location.reload();
        });

        $('#checkout').click(function () {
            $(this).attr('disabled', 'disabled');
            $(this).html('Tunggu Sebentar');
            const btn = $(this);

            $.ajax({
                url: "{{ url('/fo/carts/checkout') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: window.sessionStorage.getItem('carts')
                },
                dataType: "JSON",
                success: function (res) {
                    if (res.status === true) {
                        window.sessionStorage.removeItem('carts');
                        window.location.href = res.redirect_to;
                    } else {
                        alert_container('danger', res.message);
                        btn.removeAttr('disabled', 'disabled');
                        btn.html('Checkout');
                    }
                }
            })
        });
    });
</script>
@endsection