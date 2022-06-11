<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doubt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'is_resolved',

    ];

    protected $with = ['user'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
