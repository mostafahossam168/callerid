<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendReminderForAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:admin-reminder';

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
        $notification_ids =Notification::whereNotNull('invoice_id')->pluck('invoice_id')->toArray();
        $invoices =Invoice::whereRelation('department','is_hotel_service',1)
            ->where('departure_date',now()->addDay()->format('Y-m-d'))
            ->whereNotIn('id',$notification_ids)
            ->get();
        foreach ($invoices as $invoice){
            Notification::create([
                'invoice_id' =>$invoice->id,
                'title' => ' اوشك وقت المغادرة للفاتورة رقم '. $invoice->id,
                'type' => 'hotel_service_reminder',
                'link' => route('front.invoices.show',$invoice->id),
                'user_id' => User::admins()->first()?->id
            ]);
        }
        Log::info('cron job run at : ' . now()->format('g:i') . '-' . now()->format('Y-m-d'));

        return 1;
    }
}
