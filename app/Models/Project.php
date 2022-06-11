<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'description',
        'file_path',
        'user_id'
    ];

    protected $with = ['user'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:s',
        'updated_at' => 'datetime:d-M-Y h:s'
    ];

     /*************** RELACIONES ************************/
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}


