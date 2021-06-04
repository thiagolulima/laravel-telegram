<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use NotificationChannels\Telegram\TelegramChannel;
use Illuminate\Support\Facades\Config;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;

class ControllerUser extends Controller
{
    public function disparaMensagem()
    {
        $user = User::find(107);
       /* Notification::route('telegram' , Config::get('services.telegram_id'))
        ->notify(new TelegramNotification($user));*/
        $user->notify(new TelegramNotification($user));

    }
}
