<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'invoice_no',
        'customer_id',
        'user_id',
        'sales_type',
        'status',
        'total_amount',
        'discount_amount',
        'shipping_cost',
        'adjustable_discunt',
        'net_amount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
