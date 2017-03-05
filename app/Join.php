<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    protected $table = 'party_joins';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'party_id'
    ];




    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Party()
    {
        return $this->belongsTo('App\Party', 'party_id');
    }
}
