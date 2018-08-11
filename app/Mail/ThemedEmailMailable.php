<?php

namespace App\Mail;

use App\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThemedEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Email
     */
    private $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function build()
    {
        $content = $this->email->theme->body;
        $html    = view(['template' => $content])->with($this->email->params)->render();

        return $this->from('email@gmail.com')
            ->subject($this->email->subject)
            ->html($html)
        ;
    }
}
