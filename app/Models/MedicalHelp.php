<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHelp extends Model
{
    protected $table = 'help';
    protected $fillable = ['id', 'help_name', 'help_date', 'help_amount', 'help_description', 'status'];
}
