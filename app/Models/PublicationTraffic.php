<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationTraffic extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title', 'ip_address', 'browser', 'device', 'os'];
}
