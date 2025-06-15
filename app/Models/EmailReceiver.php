<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailReceiver extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_receivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];
}