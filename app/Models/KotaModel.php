<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class KotaModel extends Model
{
    use HasFactory;

    protected $table = 'kota';
    protected $primaryKey = 'id_kota';
    protected $fillable = ['id_kota', 'nama_kota'];

    public function paket()
    {
        return $this->hasMany(PaketModel::class, 'id_kota');
    }
}
