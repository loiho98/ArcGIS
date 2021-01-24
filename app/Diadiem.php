<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diadiem extends Model
{
    //
    protected $table = 'diadiem';
    protected $primaryKey = 'objectid';
    public $timestamps = false;
    protected $dateFormat = 'd-m-Y';
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    public $incrementing = false;
}
