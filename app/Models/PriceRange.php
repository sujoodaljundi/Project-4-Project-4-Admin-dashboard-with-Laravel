<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PriceRange extends Model
{
    // تحديد اسم الجدول إذا كان مختلف عن اسم الموديل
    protected $table = 'price_range'; // تأكد من اسم الجدول في قاعدة البيانات

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = ['name', 'description', 'deleted'];
}