<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function markAsSeen()
    {
        $this->seen = true;
        if (!$this->seen_at) {
            $this->seen_at = Carbon::now();
        }
        $this->save();
    }

    public static function send($user_id, $title, $link = null, $type = null)
    {
        static::query()->create(compact('user_id', 'title', 'link', 'type'));
    }
}
