<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedDevLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['developer_id', 'language_id'];
}
