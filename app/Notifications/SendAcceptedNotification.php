<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendAcceptedNotification extends Notification
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
      $url_web = url("/");
      $url_results = url("convocatoria/{$this->notice->slug}/resultados");
      return (new MailMessage)
              ->from('info@apertus.org.mx')
              ->subject('Aviso: Programa de Formación de Agentes Locales de Cambio')
              ->markdown('vendor.notifications.aspirant_accepted', ['url_web' => $url_web,'aspirant'=>$this->aspirant,'url_results' => $url_results])
              ->attach('csv/Carta compromiso_Fellows_Edición2018.docx',[
                   'as' => 'carta_compromiso_edicion_2018.docx',
                   'mime' => 'application/docx',
                   ]);;
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
