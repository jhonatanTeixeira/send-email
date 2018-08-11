<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $casts = [
        'recipients' => 'array',
        'params' => 'array',
    ];

    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }
}
