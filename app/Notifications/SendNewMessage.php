<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Program;

class SendNewMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$to_user,$conversation_id,$program_slug)
    {
        //
        $this->user = $user;
        $this->to_user = $to_user;
        $this->conversation_id = $conversation_id;
        $this->program_slug    = $program_slug;
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
        $program = Program::where('slug',$this->program_slug)->where('public',1)->first();
        if($program){
          $url = url("dashboard/mensajes/programa/$program->id/ver-mensajes/{$this->conversation_id}");
        }else{
          $url = url("/");
        }
      }elseif($this->to_user->type=='facilitator'){
        $url = url("tablero-facilitador/mensajes/ver/{$this->conversation_id}");
      }else{
        $url = url("tablero/$this->program_slug/mensajes/ver/{$this->conversation_id}");
      }
        return (new MailMessage)
                ->from('info@apertus.org.mx')
                ->subject('no-reply - Mensaje: Programa de Formación de Agentes Locales de Cambio')
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
