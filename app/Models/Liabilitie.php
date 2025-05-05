<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liabilitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'liabilities_name',
        'liabilities_amount',
        'liabilities_date',
        'user_id'
    ];


}
