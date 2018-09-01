<?php

/**
 * 
 * Notification Class
 * Notifies user when a new post is updated of any registered competition
 * 
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Competition;

class updatePostNotification extends Notification
{
    use Queueable;
    private $competition_id = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($competition_id)
    {
        $this->competition_id = $competition_id;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    
    {
        $competition = Competition::find($this->competition_id);
        return [
            'data' => $competition->name.' has a new post.',
            'id' => $competition->id
        ];
    }
}
