<?php
namespace App\Services\Taqnyat;

use App\Services\Taqnyat\Taqnyat;

class SMS
{
    // private const KEY = 'ccc3f2cac2ce51c2585677d36175a8db';
    // private const SENDER = 'Taqnyat.sa';


    public static function status()
    {
        $key = setting()->taqnyat_key;
        $taqnyt = new Taqnyat($key);
        $status = $taqnyt->sendStatus();
        return json_decode($status);
    }

    public static function senders()
    {
        $key = setting()->taqnyat_key;
        $taqnyt = new Taqnyat($key);
        $status = $taqnyt->senders();
        return json_decode($status);
    }

    public static function balance()
    {
        $key = setting()->taqnyat_key;
        $taqnyt = new Taqnyat($key);
        $status = $taqnyt->balance();
        return json_decode($status);
    }

    public static function send($recipients, $body)
    {
        if (!setting()->taqnyat_status) {
            $error = [
                "statusCode" => 900,
                "message" => "Service Disabled from settings , please activate service before send again"
            ];
            return (object) $error;
        }
        $key = setting()->taqnyat_key;
        $sender = setting()->taqnyat_sender;
        $taqnyt = new Taqnyat($key);
        $smsId = time();

        $message = $taqnyt->sendMsg($body, $recipients, $sender, $smsId);
        return json_decode($message);
    }
}
