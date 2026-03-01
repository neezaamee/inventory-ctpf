<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVariation extends Model
{
    protected $fillable = ['item_id', 'value', 'stock_quantity'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
