<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties'; // اسم الجدول في قاعدة البيانات

    protected $fillable = [
        'name',
        'user_id',
        'type',
        'address',
        'price',
        'description',
        'summary',
        'cover',
        'status',
        'latitude',
        'longitude',
        'category_id',
        'deleted',
        'property_status_id',
        'price_range_id',
        'property_condition_id',
    ];

    // العلاقات

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class, 'property_status_id');
    }

    public function priceRange()
    {
        return $this->belongsTo(PriceRange::class, 'price_range_id');
    }

    public function propertyCondition()
    {
        return $this->belongsTo(PropertyCondition::class, 'property_condition_id');
    }
    
}
