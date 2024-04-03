<?php

namespace App\Controllers\Manage;

use App\Controllers\Controller;
use App\SessionGuard as Guard;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductType;
use App\Models\Bill;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function __construct()
    {
        if (!Guard::isUserLoggedIn()) {
            redirect('/home');
        }

        parent::__construct();
    }

    /*** MANAGE ALL PRODUCTS ***/
    public function getAllProducts()
    {
        $products_manage = Product::join('loaisanpham', 'loaisanpham.ma_loai_san_pham', '=', 'sanpham.ma_loai_san_pham')->orderBy('sanpham.ma_san_pham', 'ASC')->get();
        $this->sendPage('manage/management', [
            'products_manage' => $products_manage
        ]);
    }


    /*** SORT PRODUCT ***/
    public function sortAllProducts()
    {
        if (isset($_POST['sort-price'])) {
            $sort_price = $_POST['sort-price'];
            if ($sort_price == 1) {
                $old_selected = array("val" => "1");
                $this->sendPage('manage/management', [
                    'products_manage' => Product::join('loaisanpham', 'loaisanpham.ma_loai_san_pham', '=', 'sanpham.ma_loai_san_pham')
                        ->orderBy('ma_san_pham', 'ASC')->get(),
                    'old_selected' => $old_selected
                ]);
            } else if ($sort_price == 2) {
                $old_selected = array("val" => "2");
                $this->sendPage('manage/management', [
                    'products_manage' => Product::join('loaisanpham', 'loaisanpham.ma_loai_san_pham', '=', 'sanpham.ma_loai_san_pham')
                        ->orderBy('gia_khuyen_mai', 'ASC')->get(),
                    'old_selected' => $old_selected
                ]);
            } else if ($sort_price == 3) {
                $old_selected = array("val" => "3");
                $this->sendPage('manage/management', [
                    'products_manage' => Product::join('loaisanpham', 'loaisanpham.ma_loai_san_pham', '=', 'sanpham.ma_loai_san_pham')
                        ->orderBy('gia_khuyen_mai', 'DESC')->get(),
                    'old_selected' => $old_selected
                ]);
            } else if ($sort_price == 4) {
                $old_selected = array("val" => "4");
                $this->sendPage('manage/management', [
                    'products_manage' => Product::join('loaisanpham', 'loaisanpham.ma_loai_san_pham', '=', 'sanpham.ma_loai_san_pham')
                        ->orderBy('created_at', 'DESC')->get(),
                    'old_selected' => $old_selected
                ]);
            }
        }
    }


    /*** CREATE NEW PRODUCT ***/
    public function showCreatePage()
    {
        $last_product = $this->createNewProductId();

        $product_type = ProductType::all();

        $this->sendPage('manage/create', [
            'errors' => session_get_once('errors'),
            'old' => $this->getSavedFormValues(),
            'ma_sp' => $last_product,
            'loai_sp' => $product_type
        ]);
    }

    public function createNewProductId()
    {
        $last_product = Product::latest('ma_san_pham')->first();
        $last_product_id = (int)trim($last_product['ma_san_pham'], "SP");    //Bỏ "SP" trong mã sản phẩm và chuyển về kiểu int
        $last_product_id++;
        $new_product_id = "SP" . $last_product_id;
        $last_product['ma_san_pham'] = $new_product_id;
        return $last_product;
    }

    public function createProduct()
    {
        $data = $this->filterProductData($_POST);
        $model_errors = Product::validate($data);
        $this->uploadImage();

        //Cập nhật lại giá khuyến mãi
        if ($data['khuyen_mai'] && $data['khuyen_mai'] >= 0) {
            $data['gia_khuyen_mai'] = $data['gia_san_pham'] - $data['gia_san_pham'] * ($data['khuyen_mai'] / 100);
        } else {
            $data['gia_khuyen_mai'] = $data['gia_san_pham'];
        }

        //Ngày tạo = hiện tại
        $data['created_at'] = Carbon::now()->tz('Asia/Ho_Chi_Minh');

        if (empty($model_errors)) {
            $product = new Product();
            $product->fill($data);
            $product->save();
            redirect('/management');
        }

        // Lưu các giá trị của form vào $_SESSION['form']
        $this->saveFormValues($_POST);
        // Lưu các thông báo lỗi vào $_SESSION['errors']
        redirect('/create', ['errors' => $model_errors]);
    }

    protected function filterProductData(array $data)
    {
        return [
            'ma_san_pham' => $data['ma_san_pham'] ?? null,
            'ten_san_pham' => $data['ten_san_pham'] ?? null,
            'gia_san_pham' => $data['gia_san_pham'] ?? null,
            'khuyen_mai' => $data['khuyen_mai'] ?? null,
            'ma_loai_san_pham' => $data['ma_loai_san_pham'] ?? null,
            'so_luong' => $data['so_luong'] ?? null,
            'hinh_anh' => basename($_FILES["hinh_anh"]["name"]) ?? null,
            'mo_ta_san_pham' => $data['mo_ta_san_pham'] ?? null
        ];
    }

    protected function uploadImage()
    {
        $errors = [];

        if (isset($_FILES["hinh_anh"])) {
            //cho phép upload jpg, png, jpeg
            $allow_type = array('jpg', 'png', 'jpeg');

            $target_dir = ROOTDIR . "/public/img/product/";
            $target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);

            //file type
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //Nếu file ảnh thuộc các loại file cho phép => upload ảnh, ngược lại, in lỗi
            if (in_array($imageFileType, $allow_type)) {
                move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file);
            }
        }
    }


    /*** UPDATE PRODUCT ***/
    public function showUpdatePage($productId)
    {
        $product = Product::where('sanpham.ma_san_pham', '=', $productId)->first();

        $product_type = ProductType::all();

        $this->sendPage('manage/update', [
            'errors' => session_get_once('errors_update'),
            'product' => $product,
            'old_value' => $this->getSavedUpdateFormValues(),
            'loai_sp' => $product_type
        ]);
    }

    public function update($productId)
    {
        $product = Product::where('ma_san_pham', '=', $productId)->first();
        $data = $this->filterProductData($_POST);
        $model_errors = Product::validate($data);

        //Nếu không chọn ảnh cập nhật => không cập nhật ảnh (not bring $data['hinh_anh'] to fill function)
        //Input file ảnh có thể cập nhật hoặc không cập nhật => nếu không cập nhật, không báo lỗi input file image
        if (!$data['hinh_anh']) {
            unset($data['hinh_anh']);
            unset($model_errors['hinh_anh']);
        }

        //Không cập nhật lại Mã Sản Phẩm và Created_at
        unset($data['ma_san_pham']);
        unset($data['created_at']);

        //Cập nhật lại giá khuyến mãi
        if ($data['khuyen_mai'] && $data['khuyen_mai'] >= 0) {
            $data['gia_khuyen_mai'] = $data['gia_san_pham'] - $data['gia_san_pham'] * ($data['khuyen_mai'] / 100);
        } else {
            $data['gia_khuyen_mai'] = $data['gia_san_pham'];
        }

        if (empty($model_errors)) {
            $product->update($data);
            $product->save();
            redirect('/management');
        }
        $this->saveUpdateFormValues($_POST);

        redirect('/manage/' . $productId, ['errors_update' => $model_errors]);
    }


    /*** DELETE PRODUCT ***/
    public function delete($productId)
    {
        $product = Product::where('ma_san_pham', '=', $productId)->first();
        $product->delete();
        redirect('/management');
    }


    /*** SORT PRODUCT ***/
    public function sortAllUsers()
    {
        if (isset($_POST['sort-user'])) {
            $sort_user = $_POST['sort-user'];
            if ($sort_user == 1) {
                $old_selected = array("val" => "1");
                $this->sendPage('manage/users', [
                    'users_manage' => User::all(),
                    'old_user_selected' => $old_selected
                ]);
            } else if ($sort_user == 2) {
                $old_selected = array("val" => "2");
                $this->sendPage('manage/users', [
                    'users_manage' => User::orderBy('id', 'ASC')->get(),
                    'old_user_selected' => $old_selected
                ]);
            } else if ($sort_user == 3) {
                $old_selected = array("val" => "3");
                $this->sendPage('manage/users', [
                    'users_manage' => User::orderBy('id', 'DESC')->get(),
                    'old_user_selected' => $old_selected
                ]);
            } else if ($sort_user == 4) {
                $old_selected = array("val" => "4");
                $this->sendPage('manage/users', [
                    'users_manage' => User::orderBy('created_at', 'DESC')->get(),
                    'old_user_selected' => $old_selected
                ]);
            } 
        }
    }


    /*** MANAGE ALL USERS ***/
    public function getAllUsers()
    {
        $users_manage = User::all();
        $this->sendPage('manage/users', [
            'users_manage' => $users_manage
        ]);
    }



    /*** MANAGE ALL BILLS ***/
    public function manageBill(){
		$khach = User::where('email', Guard::user()->email)->first();
		$this->sendPage('manage/manageBill',[
            'bills' => Bill::join('users', 'users.id', '=', 'hoadon.id')->orderBy('ma_hoa_don', 'ASC')->get()
        ]);
	}

    public function manageDetailBill(){
		$this->sendPage('manage/manageDetailBill', [
            'bill' =>Bill::join('sanpham', 'sanpham.ma_san_pham', '=', 'hoadon.ma_san_pham')->where('ma_hoa_don', $_GET['mhd'])->get()
        ]);
	}

    public function cancelBill($billId)
    {
        $data['trang_thai_giao_hang'] = "Đã hủy";
        $bill = Bill::where('ma_hoa_don', '=', $billId)->first();
        $bill->update($data);
        redirect('/manageBill');
    }


}
