<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_Invest extends Model
{
        protected $table = 'member_investment';
        public $timestamps = FALSE;
        protected $fillable =
        [
                'member_id',
                'p_share',
                'amount',
                'status',
                'date',
                'loan_status'
        ];
}
