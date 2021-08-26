<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'rate',
        'amount',
        'discount_percent',
        'discount_amount',
        'product_id',
        'purchase_id',
        'purchase_item_type',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function supplier()
    {
    return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
