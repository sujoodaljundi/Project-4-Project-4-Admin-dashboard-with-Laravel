<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'user_id',
        'contact_email',
        'message',
        'created_at',
        'is_read',
        'read_at',
        'deleted', // إضافة العمود deleted


    ];
        const UPDATED_AT = 'read_at';

}
