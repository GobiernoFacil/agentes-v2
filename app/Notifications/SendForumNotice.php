<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendForumNotice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$forum,$type,$conversation,$message)
    {
        //
        $this->user = $user;
        $this->forum = $forum;
        $this->conversation = $conversation;
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      if($this->type==='create'){
        if($this->user->type=='admin'){
          $url = url("dashboard/foros/ver/{$this->forum->id}");
        }elseif($this->user->type=='facilitator'){
          $url = url("tablero-facilitador/foros/{$this->forum->id}");
        }else{
          //fellow
            if(!$this->forum->state_name){
                $url = url("tablero/foros/{$this->forum->session->slug}/{$this->forum->slug}");
            }else{
              if($this->forum->state_name!='General'){
                $url = url("tablero/foros/{$this->forum->state_name}");
              }else{
                $url = url("tablero/foros/foro-general");
              }
            }
        }
      }elseif($this->type==='question' || $this->type==='message'){
        if($this->user->type=='admin'){
          $url = url("dashboard/foros/pregunta/ver/{$this->conversation->id}");
        }elseif($this->user->type=='facilitator'){
          $url = url("tablero-facilitador/foros/pregunta/ver/{$this->conversation->id}");
        }else{
          //fellow
            if(!$this->forum->state_name){
                $url = url("tablero/foros/pregunta/{$this->forum->session->slug}/{$this->conversation->slug}/ver");
            }else{
              if($this->forum->state_name!='General'){
                $url = url("tablero/foros/{$this->forum->state_name}/{$this->conversation->slug}/ver");
              }else{
                $url = url("tablero/foros/foro-general/{$this->conversation->slug}/ver");
              }
            }
        }
      }else{
        $url = url("/");
      }
        return (new MailMessage)
            ->from('info@apertus.org.mx')
            ->subject('no-reply')
            ->markdown('vendor.notifications.new_forum_message', ['url' => $url,'user'=>$this->user,'forum'=>$this->forum,'conversation'=>$this->conversation,'type'=>$this->type]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
