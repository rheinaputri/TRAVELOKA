<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class WisatawanModel extends Model
{
    // use HasFactory;

    protected $table = 'wisatawan';
    protected $primaryKey = 'id_wisatawan';
    protected $fillable = ['nama_wisatawan', 'jenis_kelamin', 'usia', 'alamat', 'email', 'no_telp'];


    // public function paket()
    // {
    //     return $this->hasMany(PemesananModel::class, 'id_wisatawan');
    // }
}
