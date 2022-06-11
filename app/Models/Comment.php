<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'content'
    ];


    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

     /**
     * The accessors to append to the model's array form.
     * Estos son los atributos
     * @var array
     */
    protected $appends = [
        'liked', 'disliked', 'timeAgo'
    ];

     /**************  FUNCIONES PARA OBTENER ATRIBUTOS DE LOS MODELOS **************/

     public function getTimeAgoAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getLikedAttribute() {
        return $this->likes()->where('like', 1)
            ->where('likeable_id', $this->id)
            ->where('likeable_type', get_class($this))
            ->count(); //liked
    }

    public function getdislikedAttribute() {
        return $this->likes()->where('dislike', 1)
            ->where('likeable_id', $this->id)
            ->where('likeable_type', get_class($this))
            ->count(); //disliked
    }



    /***************** RELACIONES **************/

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes() { 
        return $this->morphMany(Like::class, 'likeable');
    }


}
