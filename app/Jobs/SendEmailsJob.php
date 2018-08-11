<?php

namespace App\Jobs;

use App\Email;
use App\Mail\ThemedEmailMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Email
     */
    private $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        Mail::to($this->email->recipients)
            ->send(new ThemedEmailMailable($this->email))
        ;

        $this->email->sent_date = new \DateTime();
        $this->email->save();
    }
}
