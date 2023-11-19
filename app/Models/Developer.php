<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'profile', 'opportunity_id', 'level', 'experience', 'contact_info', 'gender', 'age'];

    public function used_dev_languages() 
    {
        return $this->hasMany(UsedDevLanguage::class);
    }
}
