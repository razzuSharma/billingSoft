<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\PurchaseItem;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'invoice_no',
        'supplier_id',
        'status',
        'purchase_type',
        'user_id',
        'shipping_cost',
        'adjustable_discount',
        'remark',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseItem()
    {
        return $this->hasmany(PurchaseItem::class);
    }
    
}