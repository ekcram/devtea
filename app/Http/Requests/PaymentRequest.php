<?php

namespace App\Http\Requests;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationDate;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_number' =>  ['required', new CardNumber],
            'card_name' => 'required|string|max:255',
            'card_expiry' =>  ['required', new CardExpirationDate('my')],
            'card_cvc' => ['required', new CardCvc($this->get('card_number'))],
            'cus_country' => 'required|string|max:255',
            'cus_email' => 'required|email|max:255',
            'cus_phone' => 'required|numeric|digits:9',
            'cus_zipcode' => 'required|numeric|digits:5',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'user_id' => 'required'
        ];
    }
}
