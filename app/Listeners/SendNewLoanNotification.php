<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LoanInstallment;

class SendNewLoanNotification
{

    public function handle($event)
    {
        $installment = LoanInstallment::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($admins, new NewUserNotification($event->user));
    }
}
