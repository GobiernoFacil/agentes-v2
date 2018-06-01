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
    public function __construct($program,$user,$forum,$type,$conversation,$message)
    {
        //
        $this->user = $user;
        $this->forum = $forum;
        $this->conversation = $conversation;
        $this->message = $message;
        $this->type = $type;
        $this->program = $program;
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
          $url = url("dashboard/foros/programa/{$this->program->id}/ver-foro/{$this->forum->id}");
        }elseif($this->user->type=='facilitator'){
          $url = url("tablero-facilitador/foros");
        }else{
          //fellow
          $url = url("tablero/{$this->program->slug}/foros/{$this->forum->slug}");
        }
      }elseif($this->type==='question' || $this->type==='message'){
        if($this->user->type=='admin'){
          $url = url("dashboard/foros/programa/{$this->program->id}/foro/{$this->forum->id}/ver-pregunta/{$this->conversation->id}");
        }elseif($this->user->type=='facilitator'){
          $url = url("tablero-facilitador/foros");
        }else{
          //fellow
          $url = url("tablero/{$this->program->slug}/foros/{$this->forum->slug}/ver-pregunta/{$this->conversation->slug}");
        }
      }else{
        $url = url("/");
      }
        return (new MailMessage)
            ->from('info@apertus.org.mx')
            ->subject('no-reply - Foro: Programa de Formación de Agentes Locales de Cambio')
            ->markdown('vendor.notifications.new_forum_message', ['url' => $url,'user'=>$this->user,'forum'=>$this->forum,'conversation'=>$this->conversation,'type'=>$this->type,'message'=>$this->message]);
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
