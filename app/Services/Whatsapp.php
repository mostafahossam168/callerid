<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class Whatsapp
{
    public static function send($phone, $message, $code = true)
    {
        $token = setting()->whatsapp_token;
        $instance_id = setting()->whatsapp_instance_id;

        if ($code) {
            $str1 = substr($phone, 1);
            $phone = '966' . $str1;
        }
        $params = [
            'token' => $token,
            'to' => $phone,
            'body' => $message,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.ultramsg.com/" . $instance_id . "/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }

    public static function sendWithImage($phone, $message, $image, $code = true)
    {
        $token = setting()->whatsapp_token;
        $instance_id = setting()->whatsapp_instance_id;

        if ($code) {
            $str1 = substr($phone, 1);
            $phone = '966' . $str1;
        }
        $params = [
            'token' => $token,
            'to' => $phone,
            'image' => $image, // image path will not work on local
            'caption' => $message,
            'priority' => 10,
            'referenceId' => '',
            'nocache' => '',
            'msgId' => '',
            'mentions' => ''
        ];
        // Log::info(json_encode($params));
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.ultramsg.com/" . $instance_id  . "/messages/image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }


    public static function sendWithDocument($phone, $message, $file, $code = true)
    {
        $token = setting()->whatsapp_token;
        $instance_id = setting()->whatsapp_instance_id;

        if ($code) {
            $str1 = substr($phone, 1);
            $phone = '966' . $str1;
        }
        $params = [
            'token' => $token,
            'to' => $phone,
            'caption' => $message,
            'priority' => 10,
            'filename' => 'hello.pdf',
            'document' => $file,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.ultramsg.com/" . $instance_id  . "/messages/image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
