<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Forum;
use App\Models\ForumLog;
use App\User;

class ForumLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:forum-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agrega logs de las conversaciones anteriores a la creación de la tabla forum_log';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->readForums();
    }
    public function readForums()
    {
      $count = 0;
      $forums = Forum::orderBy('created_at','asc')->get();
      foreach ($forums as $forum) {
        $user_level_1  = User::find($forum->user_id);
        ForumLog::firstOrCreate(['user_id'=>$forum->user_id,'forum_id'=>$forum->id,'action'=>'create-forum','type'=>$user_level_1->type]);
        $this->info($forum->topic.': Saved!');
        foreach ($forum->forum_conversations as $conversation) {
          $user_level_2  = User::find($conversation->user_id);
          ForumLog::firstOrCreate(['user_id'=>$conversation->user_id,'forum_id'=>$conversation->forum->id,'action'=>'create-question','type'=>$user_level_2->type,'conversation_id'=>$conversation->id]);
            foreach ($conversation->messages as $message) {
              $user_level_3  = User::find($message->user_id);
              ForumLog::firstOrCreate(['user_id'=>$message->user_id,'forum_id'=>$message->conversation->forum->id,'action'=>'add-message','type'=>$user_level_3->type,'conversation_id'=>$message->conversation->id,'message_id'=>$message->id]);
              $count++;
            }
            $count++;
        }
        $count++;
      }
      $this->info($count);
    }
}
