<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'roles_id',
        'user_id',
    ];
}
