<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // إذا كنت بحاجة لتحديد اسم الجدول يدوياً
    protected $table = 'appointments'; 

    // العلاقة مع الموديل User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
