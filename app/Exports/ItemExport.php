<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ItemExport implements FromView
{
    public function view(): View
    {
        $items = Item::latest()->get();

        return view('exports.items', [
            'items' => $items
        ]);
    }
}
