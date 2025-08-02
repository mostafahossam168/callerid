<?php

namespace App\Jobs;

use App\Services\Whatsapp;
use Illuminate\Bus\Queueable;
use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWhatsappMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $receivers = [], $msg, $userId;

    public function __construct($receivers, $msg, $userId)
    {
        $this->receivers = $receivers;
        $this->msg = $msg;
        $this->userId = $userId;
    }


    public function handle()
    {
        $msg = $this->msg;
        $receivers = $this->receivers->toArray();
        $batchSize = 10;
        foreach (array_chunk($receivers, $batchSize) as $batch) {
            if ($msg->attach == 1) {
                foreach ($batch as $patient) {
                    $message = WhatsappMessage::create([
                        'message' => $msg->content,
                        'patient_id' => $patient['id'],
                        'user_id' => $this->userId,
                    ]);
                    if ($patient['phone']) {
                        $send = Whatsapp::send($patient['phone'], $msg->content);
                    }
                }
            } else {
                $file_type = $this->getFileType(display_file($msg->file));
                foreach ($batch as $patient) {
                    $message = WhatsappMessage::create([
                        'message' => $msg->content,
                        'image' => $msg->file,
                        'patient_id' => $patient['id'],
                        'user_id' => $this->userId,
                    ]);
                    if ($patient['phone']) {
                        $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp', 'svg', 'ico', 'heif', 'heic', 'jfif'];
                        if (in_array($file_type, $imageExtensions)) {
                            $send = Whatsapp::sendWithImage($patient['phone'], $msg->content, display_file($msg->file));
                        } else {
                            $send = Whatsapp::sendWithDocument($patient['phone'], $msg->content, display_file($msg->file));
                        }
                    }
                }
            }
            // Log::info($send);
        }
    }

    private function getFileType($url)
    {
        return pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    }
}
