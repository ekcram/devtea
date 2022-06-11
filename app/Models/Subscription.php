<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'payment_id',
        'user_id',
        'status',
    ];

       /*************** RELACIONES ************************/
       public function users()
       {
           return $this->belongsToMany(User::class);
       }

       public function payment(){
           return $this->hasOne(Payment::class);
       }
}
