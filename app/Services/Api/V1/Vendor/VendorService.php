<?php 

namespace App\Services\Api\V1\Vendor;

use App\Models\Api\V1\Vendor\Vendor;

class VendorService{

    public function __construct()
    {

    }

    public function allVendors($per_page)
    {
        return Vendor::paginate($per_page);
    }

    public function createVendor(array $validated):Vendor{
        $vendor = DB::transaction(function () use ($data) {
            //create Vendor and add user as a vendor admin in it
            $data['slug'] = $this->generateUniqueVendorSlug($data['name']);
            $Vendor = $this->InsertVendor($data);
            // $this->addVendorAdmin(User::find($data['user']), $Vendor);
            $user = User::find($data['user']);
            $user->Vendor_id = $Vendor->id;

            return $vendor;
        });
        $user = User::find($data['user']);
        $user->vendor_id = $vendor->id;
        $user->save();
        return $vendor;
    }

     /**
     * Add a Vendor admin
     */
    public function addVendorAdmin(User $user, Vendor $Vendor): bool
    {
        $role = Role::where(['name' => 'vendor-admin', 'team_id' => null])->first();
        setPermissionsTeamId($Vendor->id);
        $user->assignRole($role);

        return true;
    }

    /**
     * Create a new Vendor
     */
    public function InsertVendor($data): Vendor
    {
        
        return Vendor::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'business_type_id' => $data['business_type_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'description' => $data['description'],
            'delivery_price' => config('settings.delivery_price'),
            'min_order' => config('settings.min_order'),
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
        ]);
    }

    public function updateVendor(array $validated, int $vendor_id): Vendor
    {
        $vendor = Vendor::findOrFail($vendor_id);
    
        $vendor->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'business_type_id' => $validated['business_type_id'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
        ]);
    
        return $vendor;
    }
    

    public function fetchVendor(int $vendorId):Vendor{
        return Vendor::findOrFail($vendorId);
    }


    /**
     * Generate a unique restaurant slug
     *
     * @param  string  $name
     * @return string
     */
    public function generateUniqueRestaurantSlug($name = null)
    {
        $name = $name.'-'.rand(1000, 9999);

        $slug = Str::slug($name);

        if (Restaurant::where('slug', $slug)->exists()) {
            return $this->generateUniqueRestaurantSlug($name);
        }

        return $slug;
    }



}