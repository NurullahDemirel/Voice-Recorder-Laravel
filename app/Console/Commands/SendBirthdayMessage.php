<?php

namespace App\Console\Commands;

use App\Mail\SenEmailUser;
use App\Models\User;
use Illuminate\Console\Command;
use Mail;

class SendBirthdayMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthdaymessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command provide to send to user message';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user=User::find(1);
        Mail::to($user->email)->send(new SenEmailUser($user));
    }
}
