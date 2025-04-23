<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketModel extends Model
{
    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    public $timestamps = false;

    protected $fillable = [
        'id_kota',
        'nama_paket',
        'durasi_hari',
        'harga_perorang',
        'fasilitas',
    ];

    public function kota()
    {
        return $this->belongsTo(KotaModel::class, 'id_kota');
    }
}
