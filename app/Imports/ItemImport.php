<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\ItemQuantity;
use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ItemImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $item = new Item([
            'name' => $row[1],
            'barcode' => isset($row[0]) ? $row[0] : null,
            'quantity' => isset($row[2]) ? $row[2] : null,
            'sale_price' => isset($row[6]) ? $row[6] : null,
            'cost_price' => isset($row[4]) ? $row[4] : null,
            'allow_quantity' => $row[2] ? 1 : 0
        ]);

        if (isset($row[3])) {
            $unit = Unit::firstOrCreate(['name' => $row[3]]);
            $item->unit_id = $unit->id;
        }
        $item->save();

        ItemQuantity::create([
            'warehouse_id' => 1,
            'item_id' => $item->id,
            'quantity' => $item->quantity,
            'type' => 'charge',
            'employee_id' => auth()->user()->id,
            'last_update' => auth()->user()->id,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
