<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = ['name', 'rank', 'belt_number', 'posting', 'contact_no'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
