<?php

namespace App\Events;

use App\Models\Invoice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Carbon\Carbon;

class InvoiceArchivedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public function __construct(public $invoice)
    {
        $this->message = "تم ترحيل فاتورة جرد رقم ".$this->invoice->inv_number ."بتاريخ" . Carbon::parse($this->invoice->created_at)->format('d M Y ,h:i A') ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('InvoiceArchivedChannel'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'invoice_number'=> $this->invoice->inv_number,
            'invoice_status'=> $this->invoice->status,
            'created_at'=> $this->invoice->created_at,
            'message' => $this->message,
        ];
    }
}
