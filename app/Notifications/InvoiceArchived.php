<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\InvoiceProduct;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class InvoiceArchived extends Notification
{
    use Queueable;
    Public $invoice;
    /**
     * Create a new notification instance.
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
        //dd($this->invoice);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
public function toMail(object $notifiable): MailMessage
{
    $pdfUrl = url("/invoice/pdf/{$this->invoice->id}");

    $invoiceProducts = InvoiceProduct::where('invoice_id', $this->invoice->id)->get();
    $pdf = PDF::loadView('admin.pages.invoices.export_to_pdf', ['invoiceProducts' => $invoiceProducts, 'invoice' => $this->invoice]);

    $pdfPath = 'invoices/' . $this->invoice->id . '/invoice.pdf';
    Storage::put($pdfPath, $pdf->output());

    return (new MailMessage)
        ->greeting('مرحبا')
        ->subject('فاتورة جرد مرحلة')
        ->line('   تم ترحيل فاتورة الجرد رقم'. $this->invoice->inv_number. '   بتاريخ ' . Carbon::parse($this->invoice->inv_post_date_time)->format('d M Y ,h:i A'))
        ->line('للمزيد من التفاصيل يرجى الضغط على الرابط')
        ->action('تفاصيل الفاتورة', route('invoices.show', ['id' => $this->invoice->id]))
        ->attach(
            storage_path('app/' . $pdfPath),
            ['as' => 'invoice.pdf']
        );
}


    public function toArray(object $notifiable): array
    {
        $createdAt = $this->invoice->create_at;
        return [
            'title'=> 'فاتورة جرد مرحلة',
            'body'=> '  تم ترحيل فاتورة الجرد رقم'.    $this->invoice->inv_number. '   بتاريخ  ' . Carbon::parse($this->invoice->inv_post_date_time)->format('d M Y ,h:i A'),
            'action' => 'invoices/show/'.$this->invoice->id,
        ];
    }
}
