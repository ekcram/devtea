<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Message;
use App\Models\Project;
use App\Traits\Likeable;
use App\Traits\Friendable;
use App\Models\PremiumChat;
use App\Models\Subscription;
use Laravel\Cashier\Billable;
use App\Models\PremiumMessage;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfileHeaderPhoto;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Friendable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasProfileHeaderPhoto;
    use TwoFactorAuthenticatable;
    use Likeable;
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'is_admin',
        'email',
        'password',
        'date_of_birth',
        'country',
        'bio',
        'address',
        'phone',
        'gender',
        'stripe_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date:Y-m-d',
        'created_at' => 'datetime:d-M-Y h:s',
        'updated_at' => 'datetime:d-M-Y h:s'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['roles','profile','subscription'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'profile_header_photo_url',
    ];

    
    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return asset('/storage/images/default-user.png');
    }

    /**
     * Get the default profile header photo URL if no profile header photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfileHeaderPhotoUrl()
    {
        return asset('/storage/images/default-header.png');
    }

    /****************** ROLES ******************************/
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    //Busca por más de un rol
    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn('name', $roles)->first() ? true : false;
    }
    // Busca por un rol
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->first() ? true : false;
    }

    /*************** RELACIONES ************************/
    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function doubts(){
        return $this->hasMany(Doubt::class);
    }

    public function subscription(){
        return $this->hasOne(Subscription::class);
    }

    public function donations(){
        return $this->hasMany(Donation::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    /****************** FUNCIONES SCOPE ******************************/
    public function scopeNotAuthUser(){
        return $this->where('id', '!=', auth()->id())->where('is_admin', 0);
    }

    public function scopeSuggestions(){
        return $this->notAuthUser()->orWhereIn('id', auth()->user()->friends_ids());
    }
  
}
