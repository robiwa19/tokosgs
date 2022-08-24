<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\JenisKategoriTenant;
use App\Models\JenisPayment;
use App\Models\Kupon;
use App\Models\ProdukTenant;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartsController extends Controller
{
    public function index() {
        if (Session::has('carts')) {
            return redirect('/fo/carts/checkout/confirm');
        }

        return view('frontend.carts');
    }

    public function checkout(Request $r) {
        if (!$r->data) {
            return response()->json([
                'status' => false,
                'message' => 'Maaf, Sepertinya keranjang belanja Anda kosong.'
            ]);
        } else {
            $carts = json_decode($r->data, true) ?? [];
            if (!in_array($carts, ['id', 'nama_produk', 'harga']))
            if (count($carts) == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Maaf, Sepertinya keranjang belanja Anda kosong.'
                ]);
            } else {
                $error = "";
                $session = [];
                foreach ($carts as $cart) {
                    $produk = ProdukTenant::where('id', $cart['id'] ?? null)->first();
                    if (!$produk) {
                        $error .= "<br />Produk {$cart['nama_produk']} tidak dapat ditemukan.";
                    } else {
                        $cart['harga'] = $produk->harga;
                        $cart['harga_format'] = "Rp " . number_format($produk->harga,0,',','.');
                        $session[] = $cart;
                    }
                }

                Session::put('carts', $session);
                if ($error != "") {
                    return response()->json([
                        'status' => false,
                        'message' => $error
                    ]);
                } else {
                    return response()->json([
                        'status' => true,
                        'redirect_to' => url('/fo/carts/checkout/confirm')
                    ]);
                }
            }
        }
    }

    public function checkoutConfirm() {
        if (!Session::has('carts')) {
            return redirect('/fo/carts');
        } else {
            $carts = Session::get('carts');
            $jenis_payments = JenisPayment::all();

            return view('frontend.confirm_checkout', [
                'carts' => $carts,
                'jenis_payments' => $jenis_payments
            ]);
        }
    }

    public function checkoutConfirmAction(Request $r) {
        if (!Session::has('carts')) {
            return redirect('/fo/carts');
        } else {
            $carts = Session::get('carts');

            $r->validate([
                'id_jenis_payment' => 'required|numeric'
            ]);

            if (JenisPayment::where('id', $r->id_jenis_payment)->count() == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Jenis Pembayaran tidak dapat ditemukan.'
                ]);
            }

            $error = "";
            $session = [];
            foreach ($carts as $cart) {
                $produk = ProdukTenant::where('id', $cart['id'] ?? null)->first();
                if (!$produk) {
                    $error .= "<br />Produk {$cart['nama_produk']} tidak dapat ditemukan.";
                } else {
                    $session[] = $produk;
                }
            }

            if ($error != "") {
                Session::forget('carts');

                return response()->json([
                    'status' => false,
                    'message' => $error,
                    'redirect_to' => url('/fo/carts')
                ]);
            } else {
                if (count($session) == 0) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Maaf, keranjang belanja Anda kosong.',
                        'redirect_to' => url('/fo/carts')
                    ]);
                }

                foreach ($session as $data) {
                    $transaksi = new Transaksi;
                    $transaksi->id_buyer = User::auth()->id;
                    $transaksi->id_tenant = $data->id_tenant;
                    $transaksi->id_jenis_payment = $r->id_jenis_payment;
                    $transaksi->is_qris = '0';
                    $transaksi->id_jenis_kategori = (JenisKategoriTenant::where('id_tenant', $data->id_tenant)->first())->id ?? null;
                    $transaksi->trx_amount = $data->harga;
                    $transaksi->discount = '0';
                    $transaksi->total_amount = $transaksi->trx_amount - $transaksi->discount;
                    $transaksi->trx_date = date("Y-m-d");
                    $transaksi->jml_kupon = '1';
                    $transaksi->path_file = '';
                    $transaksi->status_undian = 'S';
                    $transaksi->created_by = User::auth()->id;
                    $transaksi->save();

                    if ($transaksi->trx_amount > 50000) {
                        $kupon = new Kupon;
                        $kupon->id_transaksi = $transaksi->id;
                        $kupon->kupon = strtoupper(Str::random(10));
                        $kupon->created_by = User::auth()->id;
                        $kupon->save();
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Checkout berhasil.',
                    'redirect_to' => url('/fo/transaksis')
                ]);
            }
        }
    }
}
