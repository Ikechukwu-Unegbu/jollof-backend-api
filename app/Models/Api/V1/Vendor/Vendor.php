<?php

namespace App\Models\Api\V1\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
       /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'logo',
        'cover_image',
        'slug',
        'email',
        'phone',
        'business_type_id',
        'description',
        'min_order',
        'delivery_price',
        'address',
        'location',
        'city',
        'state',
        'country',
        'phone',
        'tin_document',
        'cac_document',
        'owner_id_card',
        'low_boundary',
        'upper_boundary',
        'coupon_running',
    ];

    public function user()
    {

    }

    public function businessType()
    {

    }

    public function vendorCategory()
    {

    }


}
