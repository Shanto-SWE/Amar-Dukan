<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Cart;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $order_id;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$order_id)
    {
        $this->order=$order;
        $this->order_id=$order_id;
     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
   
        return $this->subject('Invoice From Amar Dukan')->view('frontend.mail.invoice');
    }
}
