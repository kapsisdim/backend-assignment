<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vessel extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $connection = 'mongodb';
    protected $collection = 'vessels';

    protected $fillable = [
    ];

}
