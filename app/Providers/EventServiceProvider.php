<?php

namespace FI\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'FI\Events\AttachmentCreating'   => [
            'FI\Listeners\AttachmentCreatingListener'
        ],
        'FI\Events\AttachmentDeleted'    => [
            'FI\Listeners\AttachmentDeletedListener'
        ],
        'FI\Events\CheckAttachment'      => [
            'FI\Listeners\CheckAttachmentListener'
        ],
        'FI\Events\ClientCreating'       => [
            'FI\Listeners\ClientCreatingListener'
        ],
        'FI\Events\ClientDeleted'        => [
            'FI\Listeners\ClientDeletedListener'
        ],
        'FI\Events\ClientSaving'         => [
            'FI\Listeners\ClientSavingListener'
        ],
        'FI\Events\ExpenseDeleting'      => [
            'FI\Listeners\ExpenseDeletingListener'
        ],
        'FI\Events\ExpenseSaved'         => [],
        'FI\Events\InvoiceCreated'       => [
            'FI\Listeners\InvoiceCreatedListener'
        ],
        'FI\Events\InvoiceDeleted'       => [
            'FI\Listeners\InvoiceDeletedListener'
        ],
        'FI\Events\InvoiceModified'      => [
            'FI\Listeners\InvoiceModifiedListener'
        ],
        'FI\Events\InvoiceEmailed'       => [
            'FI\Listeners\InvoiceEmailedListener'
        ],
        'FI\Events\InvoiceRecurring'     => [
            'FI\Listeners\InvoiceRecurringListener'
        ],
        'FI\Events\InvoiceViewed'        => [
            'FI\Listeners\InvoiceViewedListener'
        ],
        'FI\Events\NoteCreated'          => [
            'FI\Listeners\NoteCreatedListener'
        ],
        'FI\Events\OverdueNoticeEmailed' => [],
        'FI\Events\PaymentCreated'       => [
            'FI\Listeners\PaymentCreatedListener'
        ],
        'FI\Events\QuoteCreated'         => [
            'FI\Listeners\QuoteCreatedListener'
        ],
        'FI\Events\QuoteDeleted'         => [
            'FI\Listeners\QuoteDeletedListener'
        ],
        'FI\Events\QuoteModified'        => [
            'FI\Listeners\QuoteModifiedListener'
        ],
        'FI\Events\QuoteEmailed'         => [
            'FI\Listeners\QuoteEmailedListener'
        ],
        'FI\Events\QuoteApproved'        => [
            'FI\Listeners\QuoteApprovedListener'
        ],
        'FI\Events\QuoteRejected'        => [
            'FI\Listeners\QuoteRejectedListener'
        ],
        'FI\Events\QuoteViewed'          => [
            'FI\Listeners\QuoteViewedListener'
        ],
        'FI\Events\SettingSaving'        => [
            'FI\Listeners\SettingSavingListener'
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
