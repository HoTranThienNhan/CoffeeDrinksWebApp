<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\Controller;
use App\Models\Bill;
use App\SessionGuard as Guard;

class BillController extends Controller
{
    public function payHistory(){
		$khach = User::where('email', Guard::user()->email)->first();
		$this->sendPage('bill/payHistory',['bills' => Bill::where('id', $khach->id)->orderBy('ngay_lap', 'DESC')->get()]);
	}

	public function detailBill(){
		$this->sendPage('bill/detailBill', ['bill' =>Bill::join('sanpham', 'sanpham.ma_san_pham', '=', 'hoadon.ma_san_pham')->where('ma_hoa_don', $_GET['mhd'])->get()]);
	}
}