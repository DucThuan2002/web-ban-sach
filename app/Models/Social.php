<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Social extends Model
{
    use HasFactory;

    protected $fillable = ['provider_user_id', 'provider', 'user'];

    public function login()
    {
        return $this->belongsTo(User::class, 'user');
    }

}
