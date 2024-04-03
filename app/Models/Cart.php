<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'GioHang';
    protected $primaryKey = ['id', 'ma_san_pham'];
    protected $foreignKey = 'id';
    protected $fillable = ['ma_san_pham', 'id', 'so_luong_san_pham'];
    public $incrementing = false; 
    public $timestamps = false;
    protected $keyType = ['int','string'];
}
