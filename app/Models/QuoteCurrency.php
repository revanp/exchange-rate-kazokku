<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteCurrency extends Model
{
    use HasFactory;

    protected $table = 'quote_currency';

    protected $fillable = [
        'base_currency_id',
        'currency',
        'rate'
    ];

    public function baseCurrency()
    {
        return $this->hasOne(BaseCurrency::class, 'id', 'base_currency_id');
    }
}
