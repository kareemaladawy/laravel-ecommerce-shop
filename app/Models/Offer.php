<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = [
        'image',
        'product_id',
        'discount_percentage'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
