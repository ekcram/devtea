<?php

namespace App\Models;

use App\Models\Doubt;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'chat_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doubt()
    {
        return $this->belongsTo(Doubt::class);
    }
}
