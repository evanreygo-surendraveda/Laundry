<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'nama', 'alamat', 'jenis_kelamin', 'telp'
    ];
}
