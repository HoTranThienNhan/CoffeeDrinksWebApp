<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'hoaDon';
    protected $primaryKey = 'ma_hoa_don';
    protected $foreignKey = 'ma_san_pham';
    public $timestamps = false;
    protected $fillable = [
                        'id',
                        'ma_hoa_don', 
                        'ma_san_pham',
                        'so_luong_sp',
                        'ngay_lap', 
                        'tong_tien', 
                        'hinh_thuc_thanh_toan', 
                        'khach_hang',
                        'phone', 
                        'dia_chi',
                        'trang_thai_thanh_toan',
                        'trang_thai_giao_hang'];
}