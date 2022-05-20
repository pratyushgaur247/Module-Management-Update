<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailLoginPassword;
use Mail;

class SendEmailLoginPasswordSend implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users){
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        $email = new SendEmailLoginPassword($this->users);
        Mail::to($this->users['email'])->send($email);
    }
}
