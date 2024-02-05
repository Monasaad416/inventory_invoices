<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class InvoiceCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $invoice;
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $createdAt = $this->invoice->create_at;
        return [
           'title'=> "فاتورة جديدة رقم {$this->invoice->inv_number}",
            'body' => '   تم إضافة فاتورة جرد جديدة رقم ' . $this->invoice->inv_number . '   بتاريخ ' . Carbon::parse($this->invoice->created_at)->format('d M Y، h:i A'),
            'action' => 'invoices/show/'.$this->invoice->id,
        ];
    }
    public function toBroadcast(object $notifiable): array
    {
        return [
            'title'=> "فاتورة جديدة رقم {$this->invoice->inv_number}",
            'body' => '    تم إضافة فاتورة جرد جديدة رقم ' . $this->invoice->inv_number . '   بتاريخ ' . Carbon::parse($this->invoice->created_at)->format('d M Y، h:i A'),
            'action' => 'invoices/show/'.$this->invoice->id,
        ];
    }

}
