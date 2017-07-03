<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendNewMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$to_user,$conversation_id)
    {
        //
        $this->user = $user;
        $this->to_user = $to_user;
        $this->conversation_id = $conversation_id;
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
      if($this->to_user->type=='admin'){
        $url = url("dashboard/mensajes/ver/{$this->conversation_id}");
      }elseif($this->to_user->type=='facilitator'){
        $url = url("tablero-facilitador/mensajes/ver/{$this->conversation_id}");
      }else{
        $url = url("tablero/mensajes/ver/{$this->conversation_id}");
      }
        return (new MailMessage)
                ->from('info@apertus.org.mx')
                ->subject('no-reply')
                ->markdown('vendor.notifications.new_message', ['url' => $url,'user'=>$this->user,'to_user'=>$this->to_user]);
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
