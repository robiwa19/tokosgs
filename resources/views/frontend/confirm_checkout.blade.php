@extends('layouts.front')
@section('title', 'Konfirmasi Checkout')

@section('header')
<div class="breadcrumb_section bg_gray page-title-mini" style="margin-top: -25px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Konfirmasi Checkout</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/fo') }}" title="Home">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Konfirmasi Checkout</li>
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
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($carts as $cart)
                                @php $total = $total + $cart['harga']; @endphp
                                <tr>
                                    <td><img src="{{ asset($cart['image_path_file']) }}" style="width: 100px; height: 100px;"></td>
                                    <td>{{ $cart['nama_produk'] }}</td>
                                    <td>{{ $cart['harga_format'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="divider center_icon mt-5 mb-5"><i class="ti-shopping-cart-full"></i></div>
        <form class="confirm" method="POST" action="{{ url('/fo/carts/checkout/confirm') }}" class="row">
            @csrf
            <div class="form-group col-md-12">
                <label>Pilih Jenis Pembayaran</label>
                <select name="id_jenis_payment" class="form-control">
                    <option value="">Pilih Salah Satu</option>
                    @foreach ($jenis_payments as $jp)
                        <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <div class="border p-3 p-md-4">
                    <div class="table-responsive mb-0">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">Total</td>
                                    <td class="cart_total_amount">Rp {{ number_format($total) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-fill-out btn-block confirm">Konfirmasi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('form.confirm').submit(function (e) {
            e.preventDefault();
            const btn = $('button.confirm');

            btn.attr('disabled', 'disabled');
            btn.html('Tunggu Sebentar');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function (res) {
                    if (res.status === true) {
                        alert_container('success', res.message);
                    } else {
                        alert_container('danger', res.message);
                    }

                    if (res.redirect_to) {
                        setTimeout(() => {
                            window.location.href = res.redirect_to;
                        }, 3000);
                    }

                    btn.removeAttr('disabled', 'disabled');
                    btn.html('Konfirmasi');
                },
                error: function () {
                    alert_container('danger', 'Mohon periksa input kembali.');

                    btn.removeAttr('disabled', 'disabled');
                    btn.html('Konfirmasi');
                }
            });
        });
    });
</script>
@endsection
