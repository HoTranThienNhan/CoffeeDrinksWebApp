<?php

namespace App\Controllers;

use App\Models\Product;
use App\Controllers\Controller;

class ProductController extends Controller
{

	public function product()
	{
		$this->sendPage('products/product_all', ['products' => Product::all()]);
	}
	public function productIntro()
	{
		$this->sendPage('products/product');
	}
	public function productOfType()
	{
		if (isset($_POST['all'])) {
			$this->sendPage('products/product_all', ['products' => Product::all()]);
		} else if (isset($_POST['sale'])) {
			$this->sendPage('products/product_all', ['products' => Product::where('khuyen_mai', '>', 0)->get()]);
		} else if (isset($_POST['filter'])) {
			$sort = $_POST['sort'];
			if ($sort == 1) {
				$this->sendPage('products/product_all', ['products' => Product::orderBy('gia_khuyen_mai', 'ASC')->get()]);
			} else if ($sort == 2) {
				$this->sendPage('products/product_all', ['products' => Product::orderBy('gia_khuyen_mai', 'DESC')->get()]);
			} else $this->sendPage('products/product_all', ['products' => Product::orderBy('created_at', 'DESC')->get()]);
		}else
		{
			if (isset($_POST['cafe'])) {
				$ma_lsp = 'C01';
			} else if (isset($_POST['tra'])) {
				$ma_lsp = 'C02';
			} else if (isset($_POST['khac'])) {
				$ma_lsp = 'C03';
			}
			$this->sendPage('products/product_all', ['products' => Product::where('ma_loai_san_pham', $ma_lsp)->get()]);
		}
	}


	public function detailProduct()
	{
		$this->sendPage('products/detail', ['product' => Product::where('ma_san_pham', $_GET['masp'])->first()]);
	}
}
