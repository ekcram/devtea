<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

 protected $fillable = [
        'card_number',
        'card_name',
        'card_expiry',
        'card_cvc',
        'cus_country',
        'cus_email',
        'cus_phone',
        'cus_zipcode',
        'user_id',
        'price',
        'payment_type'
    ];



  /*************** RELACIONES ************************/
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function subscription()
  {
    return $this->belongsTo(Subscription::class);
  }

  public function donation()
  {
    return $this->belongsTo(Donation::class);
  } 

}
