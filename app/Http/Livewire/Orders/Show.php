<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions;

class Show extends Component
{
    public $order, $qrCode;
    public function mount($id)
    {
        $this->order = Order::with(['items', 'user', 'client'])->findOrFail($id);
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if (strlen(setting()->tax_no) == 15) {
            $this->qrCode = Zatca::sellerName(setting()->site_name)
                ->vatRegistrationNumber(setting()->tax_no)
                ->timestamp($this->order->created_at)
                ->totalWithVat($this->order->total)
                ->vatTotal($this->order->tax)
                ->toQrCode($qrCodeOptions);
        }
    }

    public function render()
    {
        return view('livewire.orders.show');
    }
}
