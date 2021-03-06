<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function theItem()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function theUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
