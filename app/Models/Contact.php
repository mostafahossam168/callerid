<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contactNames(): HasMany
    {
        return $this->hasMany(ContactName::class, 'contact_id');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'contact_id');
    }

    protected function IsSpam(): Attribute
    {
        $contact_name_ids = $this->contactNames->pluck('id')->toArray();
        return Attribute::make(
            get: fn($value, array $attributes) => Block::whereIn('contact_name_id', $contact_name_ids)->count() >= 5,

        );
    }

    public function mostUsedName(): HasOne
    {
        return $this->hasOne(ContactName::class, 'contact_id')
            ->where('used_times','>',1)
            ->orderBy('used_times', 'desc');
    }


//    public static function getCallerInfo($phone) : ?array
//    {
//        $contact = self::where('phone_number', $phone)->first();
//        $device_registered_name = $contact?->contactNames()->where('device_id', deviceId())->first();
//
//        $most_used_name = $contact?->contactNames()->orderBy('used_times')->latest()->first();
//
//        if ($contact && ($device_registered_name || $most_used_name)) {
//            return [
//                'name' => $device_registered_name->name ?? $most_used_name->name,
//                'is_spam' => (boolean)$contact->is_spam,
//                'phone' => $phone
//            ];
//       }
//        return null;
//    }

}
