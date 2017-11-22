<?php

namespace FI\Listeners;

use FI\Events\ExpenseDeleting;

class ExpenseDeletingListener
{
    public function __construct()
    {
        //
    }

    public function handle(ExpenseDeleting $event)
    {
        foreach ($event->expense->attachments as $attachment)
        {
            $attachment->delete();
        }
    }
}
