<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queues';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'party_id', 'song_id', 'title', 'artist', 'album', 'album_image', 'votes',
    ];



    public function Party()
    {
        return $this->belongsTo('App\Party', 'party_id');
    }
}
