<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentMaterial extends Model
{
    use HasFactory;

    protected $guard = 'component_materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_id',
        'component',
        'created_at',
        'updated_at',
    ];

    public function DetailsRequests()
    {
        return $this->belongsTo(DetailsRequest::class);
    }


    public function Materials()
    {
        return $this->belongsTo(Material::class);
    }
}
