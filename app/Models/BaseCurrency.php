<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseCurrency extends Model
{
    use HasFactory;

    protected $table = 'base_currency';

    protected $fillable = [
        'currency',
    ];

    public function quoteCurrency()
    {
        return $this->hasMany(QuoteCurrency::class, 'base_currency_id', 'id');
    }
}
