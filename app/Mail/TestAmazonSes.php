<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestAmazonSes extends Mailable
{
    use Queueable, SerializesModels;

    public $email_content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_content)
    {
        $this->email_content = $email_content;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@bravebat.info')->view('emails.tpl');
    }
}
