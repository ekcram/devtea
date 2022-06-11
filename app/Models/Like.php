<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'like',
        'dislike',
        'likeable_id',
        'likeable_type',
    ];

     /*************** RELACIONES ************************/

    public function likeable(){ //function que permite crear relaciones polimórficas
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
