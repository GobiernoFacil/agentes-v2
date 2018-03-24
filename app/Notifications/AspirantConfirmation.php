<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AspirantConfirmation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($aspirant,$notice)
    {
        //
        $this->aspirant = $aspirant;
        $this->notice   = $notice;
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
      $url = url("convocatoria/aplicar/{$this->notice->slug}/{$this->aspirant->code->token}/confirmacion");
      return (new MailMessage)
          ->from('info@apertus.org.mx')
          ->subject('Confirma tu correo')
          ->markdown('vendor.notifications.aspirant_confirmation', ['url' => $url,'aspirant'=>$this->aspirant, 'notice'=>$this->notice]);
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
