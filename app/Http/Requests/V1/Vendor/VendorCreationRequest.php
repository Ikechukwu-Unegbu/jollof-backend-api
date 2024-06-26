<?php

namespace App\Http\Requests\V1\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\Vendor\VendorRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class VendorCreationRequest extends VendorRequest
{
   

    public function rules():array 
    {
        return $this->storeVendorRequest();
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,

            'message' => 'Validation errors',

            'data' => $validator->errors(),

        ]));
    }
    
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     return [
    //         //
    //     ];
    // }


   
}
