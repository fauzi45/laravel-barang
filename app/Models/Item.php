<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'lokasi_barang', 'jumlah_stok', 'satuan'];

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }
    
}
