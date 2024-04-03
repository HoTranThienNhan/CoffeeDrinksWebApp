<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'loaisanpham';
    protected $primaryKey = 'ma_loai_san_pham';
    public $incrementing = false;
    protected $fillable = ['ma_loai_san_pham', 'ten_loai_san_pham'];

}
