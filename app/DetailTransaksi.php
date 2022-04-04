<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $fillable = ['id_transaksi', 'id_paket', 'qty', 'total'];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function paket(){
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
