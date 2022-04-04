<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends Model
{
    use HasFactory;

    public const ROLE_ADMIN = 'Admin';
    public const ROLE_KASIR = 'Kasir';
    public const ROLE_OWNER = 'Owner';
}
