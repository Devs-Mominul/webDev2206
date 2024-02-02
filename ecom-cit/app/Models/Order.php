<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function rel_customer(){
        return  $this->belongsTo(Customer::class,'customer_id');
    }
}
