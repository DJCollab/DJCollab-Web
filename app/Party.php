<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = 'parties';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'password', 'host_id', 'threshold', 'created_by', 'queue'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    public function Host()
    {
        return $this->belongsTo('App\User', 'host_id');
    }

    public function CreatedBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
