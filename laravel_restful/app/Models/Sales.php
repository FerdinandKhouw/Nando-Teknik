<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'sales_date',
        'total_amount'
    ];

    public function details()
    {
        return $this->hasMany(SalesDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
