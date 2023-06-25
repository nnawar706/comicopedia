<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $message, $model, $model_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $model, $model_id)
    {
        $this->message  = $message;
        $this->model    = $model;
        $this->model_id = $model_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => $this->message,
            'model'     => $this->model,
            'model_id'  => $this->model_id,
        ];
    }
}
