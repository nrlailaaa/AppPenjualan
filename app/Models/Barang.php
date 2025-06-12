<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gambar',
        'kategori_id',
        'stok',
        'harga',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class); 
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class); 
    }
}

