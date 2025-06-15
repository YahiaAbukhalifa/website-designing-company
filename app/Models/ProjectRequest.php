<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'project_status',
        'land_area',
        'city',
        'district',
        'project_category',
        'number_of_flats',
        'cellar_count',
        'ground_floor',
        'first_round',
        'upper_annex',
        'drivers_room',
        'swimming_pool',
        'mens_diwaniya',
        'womens_diwaniya',
        'parking',
        'multiple_floors',
        'floor_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ground_floor' => 'boolean',
        'first_round' => 'boolean',
        'upper_annex' => 'boolean',
        'drivers_room' => 'boolean',
        'swimming_pool' => 'boolean',
        'mens_diwaniya' => 'boolean',
        'womens_diwaniya' => 'boolean',
        'parking' => 'boolean',
        'multiple_floors' => 'boolean',
    ];
}