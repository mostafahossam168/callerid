<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GiftResource;
use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::where('opened', 0)->orWhere('opened', null)->where('status', 1)->get();
        return $this->returnData(
            data: GiftResource::collection($gifts),
        );
    }

    public function search(Request $request)
    {
        $request->validate(
            [
                'code' => 'required|digits:4',
            ]
        );
        $gift = Gift::where('opened', 0)->orWhere('opened', null)->where('status', 1)->where('code', $request->code)->first();
        if ($gift) {
            $gift->update(
                [
                    'opened' => true,
                    'device_id' => deviceId(),
                ]
            );
            return $this->returnData(new GiftResource($gift), 'لقد ربحت الجائزه الكبرى');
        }
        return $this->returnError('لم يحالفك الحظ هذه المره');
    }
}