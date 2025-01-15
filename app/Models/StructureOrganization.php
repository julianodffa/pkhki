<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureOrganization extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'name',
        'position',
        'lawfirm',
        'email',
        'image',
        'role_id'
    ];

    /**
     * Relasi dengan model Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
