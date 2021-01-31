<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnHand extends Model
{
    protected $table = 'onhand';
    protected $fillable =
    [
        'date',
        'outward_amount',
        'outward_amount',
        'remaining_amount',
        'onhand_amount'
    ];
}
