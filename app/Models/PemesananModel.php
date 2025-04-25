<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    public $timestamps = false;

    protected $fillable = [
        'id_wisatawan',
        'id_kota',
        'id_paket',
        'jumlah_orang',
        'tanggal_berangkat',
        'tanggal_kembali'
    ];

    public function wisatawan()
    {
        return $this->belongsTo(WisatawanModel::class, 'id_wisatawan');
    }

    public function kota()
    {
        return $this->belongsTo(KotaModel::class, 'id_kota');
    }

    public function paket()
    {
        return $this->belongsTo(PaketModel::class, 'id_paket');
    }

    
}
