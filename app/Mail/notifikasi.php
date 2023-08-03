<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notifikasi extends Mailable
{
    use Queueable, SerializesModels;

    public $no_invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($no_invoice)
     {
         $this->no_invoice = $no_invoice;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sites.notif')->with(['no_invoice', $this->no_invoice]);
    }
}
