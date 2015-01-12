<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    public static function getCustomers() {
        
        $organizationId = \Auth::user()->organization_id;
        $matchThese     = ['organization_id' => $organizationId, 'status' => 1];
        $customer       = self::where($matchThese)->get()->toArray();
        
        return $customer;
    }

    public static function getAddCustomer($customerName, $customerType = 'company') {
        //http://stackoverflow.com/questions/19325312/laravel-eloquent-multiple-where

        $userId         = \Auth::user()->id;
        $organizationId = \Auth::user()->organization_id;
        $matchThese     = ['name' => $customerName, 'organization_id' => $organizationId, 'status' => 1];
        $customer       = self::where($matchThese)->get()->first();
       
        if($customer)
        {
            $customer = $customer->toArray();
            return $customer['id'];
        } else
        {
            $customers                  = new Customers();
            $customers->organization_id = $organizationId;
            $customers->name            = $customerName;
            $customers->type            = $customerType;
            $customers->created_by      = $userId;
            $customers->created_at      = new \DateTime;
            $customers->updated_at      = new \DateTime;
            $customers->save();
            
            return $customers->id;
        }
    }

}
