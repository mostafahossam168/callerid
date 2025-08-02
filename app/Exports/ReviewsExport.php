<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReviewsExport implements FromView
{
    public Collection $reviews;
    public $from, $to, $date;
    public function __construct($reviews, $date, $from = null, $to = null)
    {
        $this->reviews = $reviews;
        $this->from = $from;
        $this->to = $to;
        $this->date = $date;
    }
    public function view(): View
    {

        return view('exports.reviews', [
            'reviews' => $this->reviews,
            'from' => $this->from,
            'to' => $this->to,
            'date' => $this->date
        ]);
    }
}
