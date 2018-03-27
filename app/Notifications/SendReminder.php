<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$notice,$ext_time)
    {
        //
        $this->user = $user;
        $this->notice = $notice;
        $this->ext_time = $ext_time;
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
      $url = url("/login");
      if(!$this->ext_time){
        return (new MailMessage)
                ->from('info@apertus.org.mx')
                ->subject('Recordatorio para que complete su postulación')
                ->markdown('vendor.notifications.aspirant_reminder', ['url' => $url,'user'=>$this->user,'notice'=>$this->notice]);
      }else{
        return (new MailMessage)
                ->from('info@apertus.org.mx')
                ->subject('Aviso de extensión de tiempo para que complete su postulación')
                ->markdown('vendor.notifications.aspirant_ext_reminder', ['url' => $url,'user'=>$this->user,'notice'=>$this->notice]);
      }

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
