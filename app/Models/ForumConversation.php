<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumConversation extends Model
{
    //
    public $table = 'forum_conversations';

    protected $fillable = [
        'forum_id', 'topic','user_id','description','slug'
    ];

    function forum(){
      return $this->belongsTo("App\Models\Forum");
    }

    function messages(){
      return $this->hasMany("App\Models\ForumMessage");
    }


}
