<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public $medicine;

    public function __construct($medicine)
    {
        $this->medicine = $medicine;
    }

    public function via($notifiable)
    {
        return ['database'];  // Or use 'mail' or other channels if you want
    }
    

    public function toArray($notifiable)
    {
        return [
            'message' => 'The stock for ' . $this->medicine->name . ' is low. Only ' . $this->medicine->quantity . ' items left.',
            'medicine_id' => $this->medicine->id
        ];
    }
}
