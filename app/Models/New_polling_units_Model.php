<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_polling_units_Model extends Model
{
    use HasFactory;

    public $fillable = [
        'state',
        'lga'
    ];
}
