<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
    protected $table = 'expense';
    protected $fillable = ['id','exp_date','exp_amount','exp_description','status'];
}
