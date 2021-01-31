<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


//class NewMemberModel extends Eloquent
//class NewMemberModel extends Authenticatable




class NewMemberModel extends Authenticatable
{
//    use HasFactory;
        use Notifiable;
        protected $guard = 'member';

        protected $table = 'member';
        protected $fillable = ['name','address','mobile','email','password','pur_share','status'];

        protected $hidden = [
            'password', 'remember_token',
        ];

        
}
