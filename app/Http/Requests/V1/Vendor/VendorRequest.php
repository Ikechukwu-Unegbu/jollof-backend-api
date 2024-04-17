<?php

namespace App\Http\Requests\V1\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    protected function vendorRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'business_type_id' => ['required', 'integer', 'exists:business_types,id'],
            'description' => ['required', 'string', 'max:1000'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }

       /**
     * Get the validation rules for storing a restaurant.
     *
     * @return array
     */
    public function storeVendorRequest()
    {
        return array_merge($this->restaurantRules(),
            [
                // 'latitude' => ['required', 'numeric', 'min:-90', 'max:90'],
                // 'longitude' => ['required', 'numeric', 'min:-180', 'max:180'],
                'address' => ['required', 'string', 'max:1000'],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'user' => ['required'],
                'coupon_status' => ['nullable'],
            ]);
    }

    /**
     * Get the validation rules for updating a restaurant.
     *
     * @return array
     */
    public function updateVendorRequest()
    {
        return array_merge($this->restaurantRules(),
            [
                'logo' => ['nullable', 'image', 'max:2000', Rule::dimensions()->minWidth(200)->minHeight(200)->maxWidth(1000)->maxHeight(1000)->ratio(1)],
                'cover_image' => ['nullable', 'image', 'max:2000', Rule::dimensions()->minWidth(200)->minHeight(200)->maxWidth(2000)->maxHeight(2000)->ratio(2 / 1)],
                'latitude' => ['nullable', 'numeric', 'min:-90', 'max:90'],
                'longitude' => ['nullable', 'numeric', 'min:-180', 'max:180'],
                'address' => ['nullable', 'string', 'max:1000'],
                'city' => ['nullable', 'string', 'max:255'],
                'state' => ['nullable', 'string', 'max:255'],
                'country' => ['nullable', 'string', 'max:255'],
                'min_order' => ['string'],
                'low_boundary' => ['required', 'string'],
                'upper_boundary' => ['required', 'string'],
                'coupon_status' => ['nullable'],
            ]);
    }
   
}
