<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable=['id','restaurant_name','unique_code','gst_number','primary_contact_no','secondary_contact_no',
                       'address','is_razorpay_allowed','is_cred_allowed'];

    
}
