<?php

namespace App\Http\Controllers\User;

use App\Models\Payment;
use App\Models\Donation;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      $todayDate = date('Y-m');
      $validatedData =  $request->validate([
            'card_number' => ['required', 'numeric', 'digits:16'],
            'card_name' => ['required', 'regex:/^[a-zA-Zñª\s.á-úÁ-Ú]+$/i', 'max:100'],
            'card_expiry' => ['required','date_format:Y-m', 'after_or_equal:'.$todayDate],
            'card_cvc' => ['required', 'numeric', 'digits:3'],
            'cus_country' => ['required', 'alpha', 'max:100'],
            'cus_email' => ['required', 'email', 'email:rfc,dns'],
            'cus_phone' => ['required', 'numeric', 'digits:9'],
            'cus_zipcode' => ['required', 'numeric', 'digits:5'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'user_id' => 'required'
        ]);

       $payment =  Payment::create([
            'card_number' => $request->card_number,
            'card_name' => $request->card_name,
            'card_expiry' => $request->card_expiry,
            'cus_phone' => $request->cus_phone,
            'card_cvc' => $request->card_cvc,
            'cus_email' => $request->cus_email,
            'cus_country' => $request->cus_country,
            'cus_zipcode' => $request->cus_zipcode,
            'price' => $request->price,
            'user_id' => $request->user_id,
            'payment_type' => $request->payment_type
        ]);

        if($request->payment_type === 'subscription'){
            $subscription = Subscription::where('user_id', auth()->id())->update([
                'payment_id' => $payment->id,
                'status' => 'active',
            ]);
        } else if($request->payment_type === 'donation'){
            $donation = Donation::create([
                'name' =>  'Micro-donación (DevTea)',
                'parent_id' => $request->parent_id,
                'payment_id' => $payment->id,
                'user_id' => $request->user_id,
                'amount' => $request->price
            ]);
        }

        return Redirect::route('dashboard.index')->with('success', 'Pago realizado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }
}
