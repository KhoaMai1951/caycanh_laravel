<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class EmailActivate extends Model
{
    protected $table = "email_activate";

    public $timestamps = false;


    protected $fillable = [
        'username', 'name', 'email', 'password',  'activation_token'
    ];

    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];
}
