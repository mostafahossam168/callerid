<?php

namespace App\Http\Controllers\Api;

use App\Models\Block;
use App\Models\Contact;
use App\Models\ContactName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlockResource;
use App\Http\Resources\ContactNameResource;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::where([
            'device_id' => deviceId()
        ])->paginate(10);
        return $this->returnData(
            data: BlockResource::collection($blocks),
            pagination: $this->make_pagination($blocks)
        );
    }

    public function toggle(Request $request)
    {
        if (!deviceId()) {
            return $this->returnError('معرف الجهاز مطلوب');
        }
        $request->validate([
            'blocked_number' => 'required',
            'name' => 'required',
        ]);
        $contact = Contact::firstOrCreate([
            'phone_number' => $request->blocked_number,
        ]);

        $contactName = ContactName::firstOrCreate([
            'name' => $request->name,
            'contact_id' => $contact->id,
        ]);

        $block = Block::where(['device_id' => deviceId(), 'contact_name_id' => $contactName->id])->first();
        if ($block) {
            $block->delete();
            $msg = 'تم الغاء حظر الرقم بنجاح';
        } else {
            Block::create(['device_id' => deviceId(), 'contact_name_id' => $contactName->id]);
            $msg = 'تم حظر الرقم بنجاح';
        }
        return $this->returnSuccessMessage($msg);
    }

    public function Intruders()
    {
        $blocks = Block::select('contact_name_id')
            ->groupBy('contact_name_id')
            ->havingRaw('COUNT(*) >= 4')
            ->get();

        $intruders = ContactName::whereIn('id', $blocks->pluck('contact_name_id'))->get();
        return $this->returnData(
            ContactNameResource::collection($intruders)
        );
    }
}
