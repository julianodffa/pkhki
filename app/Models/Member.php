<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Define the table name if it does not follow the plural form convention
    protected $table = 'members';

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'ktp',
        'photo',
        'institution',
        'position',
        'company_email',
        'is_member_of_other_legal_association',
        'immigration_law_consultant_certificate',
        'other_certificates',
        'is_accepted_as_member',
    ];

    // Cast JSON column to an array for easy access
    protected $casts = [
        'other_certificates' => 'array',
        'is_member_of_other_legal_association' => 'boolean',
        'is_accepted_as_member' => 'boolean',
    ];
}
