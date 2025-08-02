<?php

namespace App\Console\Commands;

use App\Models\InvoiceItem;
use App\Models\Notification;
use App\Models\User;
use App\Services\Whatsapp;
use Illuminate\Console\Command;

class SendVaccineNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:vaccine-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $items = InvoiceItem::whereNotNull('vaccine_id')
            ->where('next_vaccine_date', '=', now()->addDay()->format('Y-m-d'))
            ->whereHas('invoice')
            ->get();
        foreach ($items as $item) {
            $patient = $item->invoice?->patient;
            if ($patient){
                $patient_msg = 'اقترب ميعاد تطعيم ' . $item->vaccine->name . ' للاليف ' . $item->animal->name . ' الرجاء التوجه للعبادة ';
                $phone = $patient->phone ?? $patient->phone2;
                if ($phone) {
                    Whatsapp::send($phone, $patient_msg);
                }
                $admin_msg = 'اقترب ميعاد التطعيم للمالك ' . $patient->name . 'للحيوان ' . $item->animal?->name;
                Notification::send(User::admins()->first()->id, $admin_msg, route('front.patients.show', $patient->id));
                \Log::info('Cron job worked for patient : ' . $patient->id . 'in ' . date('Y-m-d'));
            }
        }
        return 1;
    }
}
