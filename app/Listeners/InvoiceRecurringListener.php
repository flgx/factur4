<?php

namespace FI\Listeners;

use FI\Events\InvoiceEmailed;
use FI\Events\InvoiceRecurring;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\Parser;

class InvoiceRecurringListener
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
     * @param  InvoiceRecurring $event
     * @return void
     */
    public function handle(InvoiceRecurring $event)
    {
        if (config('fi.automaticEmailOnRecur') and $event->invoice->client->email)
        {
            $parser = new Parser($event->invoice);

            if (!$event->invoice->is_overdue)
            {
                $subject = $parser->parse('invoiceEmailSubject');
                $body    = $parser->parse('invoiceEmailBody');
            }
            else
            {
                $subject = $parser->parse('overdueInvoiceEmailSubject');
                $body    = $parser->parse('overdueInvoiceEmailBody');
            }

            $mail = $this->mailQueueRepository->create($event->invoice, [
                'to'         => $event->invoice->client->email,
                'cc'         => config('fi.mailDefaultCc'),
                'bcc'        => config('fi.mailDefaultBcc'),
                'subject'    => $subject,
                'body'       => $body,
                'attach_pdf' => config('fi.attachPdf')
            ]);

            $this->mailQueue->send($mail->id);

            event(new InvoiceEmailed($event->invoice));
        }
    }
}
