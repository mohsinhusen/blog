<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Loan_Application extends Model
{
    use Notifiable;
    protected $table = 'loan_application';
    protected $fillable = ['member_id', 'name', 'date', 'loan_type', 'loan_reason', 'loan_amount', 'loan_duration', 'status'];
}
