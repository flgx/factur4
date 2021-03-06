<?php

namespace FI\Events;

use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\MailQueue\Models\MailQueue;
use Illuminate\Queue\SerializesModels;

class OverdueNoticeEmailed extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, MailQueue $mail)
    {
        $this->invoice = $invoice;
        $this->mail    = $mail;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
