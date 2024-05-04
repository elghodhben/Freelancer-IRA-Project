<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsRequest extends Model
{
    use HasFactory;

    protected $guard = 'details_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'request_id ',
        'component_material_id ',
        'created_at',
        'updated_at',
    ];

    public function requests()
    {
        return $this->belongsTo(Requests::class);
    }


    public function componentMaterial()
    {
        return $this->hasMany(ComponentMaterial::class);
    }
}
