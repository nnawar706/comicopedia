<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminRegistrationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $admin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($admin)
    {
        $this->admin = $admin;
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
        return (new MailMessage)
                    ->subject('New Account')
                    ->greeting('Dear ' . $this->admin['name'])
                    ->line('A new account has been created for you.')
                    ->line('Your credentials: ')
                    ->line('email: '.$this->admin['email'] . ' , password: ' . $this->admin['password'])
                    ->action('Welcome to Mangamania', url('http://localhost:8000/admin/login'));
    }
}
