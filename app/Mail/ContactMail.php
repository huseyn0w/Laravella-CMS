<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $mail_subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
        $this->mail_subject = $data['subject'];

        $this->message =  (new MailMessage)
            ->greeting('Hello!')
            ->line('You have got 1 message from contact page!')
            ->line('From: '.$data['email'])
            ->line('Subject: '.$data['subject'])
            ->line('Person: '.$data['first_name'].' '.$data['last_name'])
            ->line('Message: '.$data['message']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->data);
//        return $this->from(env('MAIL_USERNAME'))
//            ->subject($this->mail_subject)
//            ->view('email.contactmail')
//            ->with('data', $this->data);
        return $this->markdown('vendor.notifications.email', $this->message->data());
    }
}
