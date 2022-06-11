<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    //Cambia el formato de la fecha y hora
    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:s',
        'updated_at' => 'datetime:d-M-Y h:s'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
