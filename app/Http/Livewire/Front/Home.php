<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $screen = 'latest', $from, $to;

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('appointment_date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('appointment_date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('appointment_date', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function render()
    {
        $users = User::doctors()->with(['appointments' => function ($q) {
            $this->between($q);
        }])->get();
        return view('livewire.front.home', compact('users'));
    }
}
