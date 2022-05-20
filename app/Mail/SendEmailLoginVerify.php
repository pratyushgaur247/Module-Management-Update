<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;

class SendEmailLoginVerify extends Mailable{
    use Queueable, SerializesModels;

    protected $users;

    const CODE = [
        'first_name' => '[first_name]',
        'last_name'  => '[last_name]',
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users){
        $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $users = $this->users;
        $template = EmailTemplate::where('id', '2')->select('content', 'subject')->get();
        $body = $this->replaceContentEmail($template[0]->content);

        $subject = "Hi ". $users['first_name'] .", ".$template[0]->subject;
        return $this->view('emails.login-verify-template')->subject($subject)->with(['content' => $body]);
    }

    public function replaceContentEmail($content){
        if(!empty($content)){
            foreach(self::CODE as $item => $value){
                $replace = '';
                switch ($item){
                    case "first_name":
                    if($this->users){
                        $replace = $this->users['first_name'];
                    }
                    break;
                    case "last_name":
                    if($this->users){
                        $replace = $this->users['last_name'];
                    }
                    break;
                }
                $content = str_replace($value, $replace, $content);
            }
            return $content;
        }
    }
}
