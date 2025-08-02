<?php

namespace App\Http\Livewire\Front;

use Carbon\Carbon;
use App\Models\Account;
use Livewire\Component;
use App\Models\AccountReview;
use App\Exports\ReviewsExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class Reviews extends Component
{
    public $opening_credit_balance, $debit_opening_balance, $selected_review, $date, $transfers = [];
    public $from, $to;

    public  $allReviews = [];

    public function export()
    {

        return Excel::download(new ReviewsExport($this->sortReviews(), $this->date, $this->from, $this->to), 'reviews' . time() . '.xlsx');
    }
    public function render()
    {
        // $reviews = AccountReview::where(function ($q) {
        //     if ($this->date) {
        //         $q->where('year', $this->date);
        //     } else {
        //         $q->where('year', Carbon::now()->format('Y'));
        //     }
        // })->get();
        $reviews = $this->sortReviews();
        $this->allReviews = $this->sortReviews();
        $totalDebit = 0;
        $totalCredit = 0;
        $totalBalance = 0;
        $totalClosedDebit = 0;
        $totalClosedCredit = 0;
        return view('livewire.front.reviews', compact('reviews', 'totalDebit', 'totalCredit', 'totalBalance', 'totalClosedDebit', 'totalClosedCredit'));
    }


    public function mount()
    {
        $this->date = Carbon::now()->format('Y');
        if ($year = cache('accounting_year')) {
            $this->from = Carbon::parse($year . '-01-01')->format('Y-m-d');
            $this->to = Carbon::parse($year . '-12-31')->format('Y-m-d');
            $this->date = $year;
        } else {
            $this->date = Carbon::now()->format('Y');
        }
    }
    public function submitReview()
    {
        $data = $this->validate([
            'opening_credit_balance' => 'nullable',
            'debit_opening_balance' => 'nullable',
        ]);
        $this->selected_review->update($data);
        $this->reset(['opening_credit_balance', 'debit_opening_balance']);
        $this->selected_review = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function edit(AccountReview $review)
    {
        $this->opening_credit_balance = $review->opening_credit_balance;
        $this->debit_opening_balance = $review->debit_opening_balance;
        $this->selected_review = $review;
    }

    public function addYearReview()
    {
        $accounts = Account::all();
        AccountReview::where('year', $this->date)->delete();
        foreach ($accounts as $account) {
            $account->reviews()->create(['year' => $this->date]);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function transfer(AccountReview $review, $balance)
    {
        $account = $review->account;
        $nextReview = AccountReview::where('account_id', $account->id)->where('year', ($this->date + 1))->first();
        if (is_null($nextReview)) {
            return ['type' => 'error', 'message' => 'يجب عليك إضافة ميزان تجاري لسنة ' . ($this->date + 1) . ' اولا حتي تستطيع الترحيل الية'];
        } else {
            // dd($balance);
            // if ($balance === 0) {
            //     $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'لا يوجد رصيد لترحيلة']);
            // } else {
            if ($balance > 0) {
                $nextReview->update(['opening_credit_balance' => $balance]);
            } else {
                $nextReview->update(['debit_opening_balance' => $balance]);
            }
            return ['type' => 'success'];
            // }
        }
    }

    public function bulkTransfer()
    {
        $errors = false;
        foreach ($this->transfers as $reviewId => $balance) {
            $data = $this->transfer(AccountReview::find($reviewId), $balance);
            // dd($data);
            if ($data['type'] == 'error') {
                $this->dispatchBrowserEvent('alert', $data);
                $errors = true;
                break;
            }
        }
        if (!$errors) {
            $this->transfers = [];
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        }
    }

    public function resetFromTo()
    {
        $this->reset(['from', 'to']);
        $this->date = Carbon::now()->format('Y');
    }


    private function sortReviews()
    {
        $reviews = collect([]);
        $accounts = Account::with('kids')->whereNull('parent_id')->get();
        foreach ($accounts as $account) {
            $re = $account->reviews()->where('year', $this->date)->first();
            if ($re) {
                $reviews->push($re);
            }
            foreach ($account->kids as $acc) {
                $r = $acc->reviews()->where('year', $this->date)->first();
                if ($r) {
                    $reviews->push($r);
                }
                foreach ($acc->kids as $last) {
                    $l =  $last->reviews()->where('year', $this->date)->first();
                    if ($l) {
                        $reviews->push($l);
                    }
                    foreach ($last->kids as $last1) {
                        $ll =  $last1->reviews()->where('year', $this->date)->first();
                        if ($ll) {
                            $reviews->push($ll);
                        }
                        foreach ($last1->kids as $last2) {
                            $lll =  $last2->reviews()->where('year', $this->date)->first();
                            if ($lll) {
                                $reviews->push($lll);
                            }
                        }
                    }
                }
            }
        }
        return $reviews;
    }
}
