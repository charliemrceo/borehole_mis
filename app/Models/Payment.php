<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[

        'record_date',
        'narration',
        'amount',
        'plot_id'
    ];

};
