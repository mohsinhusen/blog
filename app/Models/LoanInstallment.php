<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LoanInstallment extends Model
{
    use Notifiable;

    protected $table = 'loan_installment';
    protected $fillable = ['loan_id', 'member_id', 'inst_amount', 'amount_profit', 'inst_date', 'inst_status', 'inst_penalty', 'status'];
}
