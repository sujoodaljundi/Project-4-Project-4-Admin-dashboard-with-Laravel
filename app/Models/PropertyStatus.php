<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyStatus extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان مختلف عن اسم الموديل
    protected $table = 'property_status';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = ['name', 'description', 'deleted']; // اضف الحقول التي تستخدمها في جدول `property_status`
}
