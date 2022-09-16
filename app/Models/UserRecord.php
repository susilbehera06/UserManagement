<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecord extends Model
{
    use HasFactory;

    protected $table = 'user_records';
    protected $fillable = ['fname','email','join_date','leave_date','status','avatar'];
}
