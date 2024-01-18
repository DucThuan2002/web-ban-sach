<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'decription',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb'
    ];

    protected $attributes = [
        'price' => '0',
        'price_sale' => '0',
    ];

    public function menu() {
        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => ' ']);
    }
}
