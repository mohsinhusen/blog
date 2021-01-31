<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
        //    use HasFactory;
        protected $table = 'loan';
        protected $fillable = [
                'loan_type',
                'loan_date',
                'loan_no',
                'member_id',
                'loan_reason',
                'loan_amt',
                'loan_profit',
                'loan_installment',
                'loan_duration',
                'loan_g_1',
                'loan_g_2',
                'status',
        ];
}
