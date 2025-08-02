<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Console\Command;
use App\Models\PharmacyMedicine;

class SendMedicineExpireReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medicine:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A reminder to admins 7 days before the medicine expires';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $medicines = PharmacyMedicine::whereDate('expiry_date', Carbon::now()->addDays(7)->format('Y-m-d'));
        $admins = User::admins()->get();
        foreach ($medicines as $item) {
            foreach ($admins as $admin) {
                Notification::create([
                    'medicine_id' => $item->id,
                    'title' => 'متبقي 7 ايام على انتهاء صلاحية الدواء ' . $item->name . ' - ' . $item->scientific_name,
                    'type' => 'medicine_reminder',
                    'link' => route('front.pharmacy', ['screen' => 'medicine']),
                    'user_id' => $admin->id
                ]);
            }
        }
    }
}
