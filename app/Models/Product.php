<?php

namespace App\Models;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'images',
        'model',
        'description',
        'details',
        'qty',
        'weight',
        'unit_price',
        'sale_price',
        'active',
        'featured',
    ];

    protected $casts = [
        'qty'  =>  'integer',
        'brand_id'  =>  'integer',
        'active'    =>  'boolean',
        'featured'  =>  'boolean',
        'images' => 'array'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', true);
        });
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($item) {
            if ($item->qty == 0) {
                $item->update([
                    'active' => false
                ]);
            }
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function scopeRecentlyAdded(Builder $query): void
    {
        $query->where('created_at', '>=', config('settings.new_arrival_date.value') ?? Carbon::now()->subDays(30));
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', true);
    }
}
