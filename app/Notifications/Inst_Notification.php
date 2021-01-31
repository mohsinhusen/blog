<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\LoanInstallment;


class Inst_Notification extends Notification
{
    use Queueable;
    private $installment;

    public function __construct($installment)
    {
        $this->installment = $installment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'loan_id' => $this->installment['loan_id'],
            'member_id' => $this->installment['member_id'],
            'inst_amount' => $this->installment['inst_amount'],
            'inst_date' => $this->installment['inst_date'],
            'inst_penalty' => $this->installment['inst_penalty']
        ];
    }
}
