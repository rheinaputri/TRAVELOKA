<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinasiModel extends Model
{
    protected $table = 'destinasi';
    protected $primaryKey = 'id_destinasi';
    public $timestamps = false;

    protected $fillable = [
        'nama_destinasi',
        'id_kota',
        'id_paket',
    ];

    public function kota()
    {
        return $this->belongsTo(KotaModel::class, 'id_kota');
    }

    public function paket()
    {
        return $this->belongsTo(PaketModel::class, 'id_paket');
    }
}
