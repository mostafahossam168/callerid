<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Models\ContactName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactNameResource;

class ContactController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        // $key = substr($request->search, 2);
        $countryCodes = countryCode();
        $number = $request->search;

        foreach ($countryCodes as $code) {
            if (strpos($number, $code) === 0) {
                $number = substr($number, strlen($code));
                break;
            }
        }

        $contatcts = ContactName::whereRelation('contact', 'phone_number', 'LIKE', '%' . $number  . '%')
            ->get();

        return $this->returnData(
            data: ContactNameResource::collection($contatcts),
        );
    }


    public function addContacts(Request $request)
    {
        $request->validate([
            'contacts' => 'required|array',
            'contacts.*.name' => 'nullable|string',
            'contacts.*.phone_numbers' => 'nullable|array',
            'contacts.*.phone_numbers.*' => 'nullable|string',
            // 'contacts.*.phone_numbers.*' => 'nullable|string|distinct',
        ]);
        $counter = 0;
        $contactCounter =  0;
        foreach ($request->contacts as $contactData) {
            if (!empty($contactData['name']) && !empty($contactData['phone_numbers'])) {
                foreach ($contactData['phone_numbers'] as $phoneNumber) {
                    if (!empty($phoneNumber)) {
                        $contact = Contact::firstOrCreate([
                            'phone_number' => $phoneNumber,
                        ]);
                        $name = ContactName::where(['name' => $contactData['name']])->first();
                        if ($name) {
                            $name->update(['used_times' => $name->used_time + 1]);
                        } else {
                            ContactName::create([
                                'contact_id' => $contact->id,
                                'name' => $contactData['name'],
                                // 'device_id' => $contactData['device_id'],
                                'device_id' => deviceId(),
                            ]);
                        }
                        $counter++;
                    }
                    $contactCounter++;
                }
            }
        }
        Log::info('contacts added', [
            'uploaded_contacts' => count($request->contacts),
            'saved_contacts' => $contactCounter,
            'saved_numbers' => $counter,
        ]);
        return $this->returnData([
            'uploaded_contacts' => count($request->contacts),
            'saved_contacts' => $contactCounter,
            'saved_numbers' => $counter,
        ], 'تم  حفظ البيانات بنجاح');
    }

    public function show($phone)
    {
        $contact = Contact::where('phone_number', $phone)->firstOrFail();
        $data = [
            'names' => ContactNameResource::collection($contact->contactNames),
            'is_spam' => $contact->is_spam,
        ];
        return $this->returnData($data);
    }
}
