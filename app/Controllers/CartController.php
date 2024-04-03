<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\Controller;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\Product;
use Illuminate\Support\Facades\Date;
use App\SessionGuard as Guard;
use PDOException;

class CartController extends Controller
{
	public function addCart()
	{
		$user_id = User::where('email', Guard::user()->email)->first()->id;
		try {
			Cart::create([
				'ma_san_pham' => $_POST['masp'],
				'id' => $user_id,
				'so_luong_san_pham' => $_POST['so-luong']
			]);
		} catch (PDOException $pe) {
			$soluong = Cart::where('ma_san_pham', $_POST['masp'])->where('id', $user_id)->first()->so_luong_san_pham;
			$gio = Cart::join('sanPham', 'sanPham.ma_san_pham', '=', 'GioHang.ma_san_pham')->where('sanPham.ma_san_pham', $_POST['masp'])->first();
			if ($gio->so_luong_san_pham < $gio->so_luong) {
				Cart::where('ma_san_pham', $_POST['masp'])->where('id', $user_id)->update([
					'so_luong_san_pham' => ($soluong + $_POST['so-luong'])
				]);
				redirect('/cart');
			}
		}
		redirect('/cart');
	}

	public function del()
	{
		$user_id = User::where('email', Guard::user()->email)->first()->id;
		$soluong = Cart::where('ma_san_pham', $_POST['masp'])->where('id', $user_id)->first()->so_luong_san_pham;
		if ($soluong > 1) {
			Cart::where('ma_san_pham', $_POST['masp'])->where('id', $user_id)->update([
				'so_luong_san_pham' => ($soluong - $_POST['so-luong'])
			]);
		}
		redirect('/cart');
	}

	public function cart()
	{
		if (!Guard::isUserLoggedIn()) {
			redirect('/login');
		}
		$user_id = User::where('email', Guard::user()->email)->first()->id;
		$this->sendPage('cart/cart', ['carts' => Cart::join('sanpham', 'sanpham.ma_san_pham', '=', 'giohang.ma_san_pham')->where('id', $user_id)->get()]);
	}


	public function delCart()
	{
		$user= User::where('email', Guard::user()->email)->first();
		Cart::where('ma_san_pham', $_GET['masp'])->where('id', $user->id)->delete();
		redirect('/cart');
	}

	public function pay()
	{
		$khach = User::where('email', Guard::user()->email)->first();
		$gio = Cart::join('sanPham', 'sanPham.ma_san_pham', '=', 'giohang.ma_san_pham')->get();

		foreach ($gio as $gh) {
			foreach (Product::where('ma_san_pham', $gh->ma_san_pham)->get() as $prd) {
				$prd->update(['so_luong' => ($gh->so_luong - $gh->so_luong_san_pham)]);
			}
		}
		
		$hd = Bill::latest('ma_hoa_don')->first();
		$mhd = $hd['ma_hoa_don'] + 1;
		foreach (Cart::where('id', $khach->id)->get() as $cart) {
			Bill::create([
				'ma_hoa_don' => $mhd,
				'id' => $khach->id,
				'ma_san_pham' => $cart->ma_san_pham,
				'ngay_lap' => Date::now(7),
				'tong_tien' => $_POST['tong-tien'],
				'so_luong_sp' => $cart->so_luong_san_pham,
				'khach_hang' => $khach->name,
				'phone' => $_POST['phone'],
				'dia_chi' => $_POST['address'],
				'trang_thai_thanh_toan' => 'Chưa thanh toán',
				'trang_thai_giao_hang' => 'Đang chuẩn bị hàng'
			]);

			Cart::where('ma_san_pham', $cart->ma_san_pham)->where('id', $cart->id)->delete();
		}
		$this->sendPage('cart/pay');
	}
}
