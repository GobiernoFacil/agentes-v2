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
      return $this->belongsTo("App\Models\Forum",'forum_id');
    }

    function messages(){
      return $this->hasMany("App\Models\ForumMessage",'conversation_id');
    }

    function user(){
      return $this->belongsTo("App\User");
    }


}
