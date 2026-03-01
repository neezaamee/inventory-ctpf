<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['item_variation_id', 'officer_id', 'user_id', 'type', 'quantity', 'remarks'];

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
