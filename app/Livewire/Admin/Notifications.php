<?php

namespace App\Livewire\Admin;

use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\NotificationLibrary;
use App\Models\User;
use App\Services\FCMService;
use Livewire\Component;

class Notifications extends Component
{
    public $title, $user_id, $selected, $library_id;
    public $SelectAll = false;
    public $selectedNotifications = [];
    public $screen = 'index';


    public function deleteSelected()
    {
        \DB::table('notifications')->whereIn('id', $this->selectedNotifications)->delete();
        $this->reset();
        session()->flash('success', 'تم الحذف بنجاح');

    }

    public function deleteAll()
    {
        \DB::table('notifications')->delete();
        $this->reset();
        session()->flash('success', 'تم الحذف بنجاح');

    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedNotifications = Notification::pluck('id');
        } else {
            $this->selectedNotifications = [];
        }
    }

    public function submit()
    {
        $data = $this->validate([
            'selected' => 'required|in:one_user,two_user,all_users',
            'user_id' => $this->selected == 'one_user' ? 'required|exists:users,id' : 'nullable',
            'library_id' => 'required|exists:notification_libraries,id'
        ]);
        $library =NotificationLibrary::findOrFail($this->library_id);
        unset($data['selected']);
        if ($this->selected == 'one_user') {
            $notification = Notification::create([
                'user_id' => $data['user_id'],
                'title' => $library->content,
                'library_id' => $library->id
            ]);
        } else {
            foreach (User::clients()->get() as $user) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'title' => $library->content,
                    'library_id' => $library->id
                ]);
            }
        }
        session()->flash('success', 'تم الارسال بنجاح');
        $this->screen = 'index';
    }

    public function render()
    {
        $notifications = Notification::paginate();
        return view('livewire.admin.notifications.index', compact('notifications'))->extends('admin.layouts.admin')->section('content');
    }
}
