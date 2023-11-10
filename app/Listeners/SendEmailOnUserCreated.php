<?php

namespace App\Listeners;

use App\Events\UserCreated;
use \App\Models\User;
use App\Services\Mailchimp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailOnUserCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::find($event->userId);
        $mailService = new Mailchimp();
        $mailService->send($user->email, $user->name, 'Thanks for registration', 'Dear user, welcome to our website!');
    }
}
