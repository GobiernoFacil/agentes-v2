<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{
    //
    public $table = 'news_events';
    protected $fillable = [
    'user_id',
    'title',
    'content',
    'start',
    'end',
    'slug',
    'time',
    'type',
    'public'
    ];
}
