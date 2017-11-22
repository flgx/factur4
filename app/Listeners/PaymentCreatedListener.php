<?php

namespace FI\Listeners;

use FI\Events\PaymentCreated;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\Parser;

class PaymentCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MailQueue $mailQueue, MailQueueRepository $mailQueueRepository)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentCreated $event
     * @return void
     */
    public function handle(PaymentCreated $event)
    {
        // Do not send the payment receipt unless required conditions are met
        if (($event->checkEmailOption == true and !config('fi.automaticEmailPaymentReceipts')) or !$event->payment->invoice->client->email)
        {
            return;
        }

        $parser = new Parser($event->payment);

        $mail = $this->mailQueueRepository->create($event->payment, [
            'to'         => $event->payment->invoice->client->email,
            'cc'         => config('fi.mailDefaultCc'),
            'bcc'        => config('fi.mailDefaultBcc'),
            'subject'    => $parser->parse('paymentReceiptEmailSubject'),
            'body'       => $parser->parse('paymentReceiptBody'),
            'attach_pdf' => config('fi.attachPdf')
        ]);

        $this->mailQueue->send($mail->id);
    }
}
