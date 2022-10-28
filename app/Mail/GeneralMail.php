<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;

    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build()
    {
        $title = 'New Task';
        $body = 'Hi '.$this->task->User->name.', there is new task for you.';
        $buttontext = 'Check this out';
        $buttonurl = route('todo.index');
        return $this->subject("New Task")->markdown('emails.general', [
            'title'=>$title,
            'body'=>$body,
            'buttontext'=>$buttontext,
            'buttonurl'=>$buttonurl
        ]);
    }
}
