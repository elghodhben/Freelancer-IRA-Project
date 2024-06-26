<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{
    use HasFactory;


    protected $guard = 'reset_code_passwords';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'email',
        'code',
        'created_at',
    ];
}
