<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Transaksi extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id_member', 'tgl', 'batas_waktu', 'tgl_bayar', 'status', 'status_bayar', 'id_user'
    ];

    public function member(){
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

}
