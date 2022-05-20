<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;

class SendEmailLoginPassword extends Mailable{
    use Queueable, SerializesModels;

    protected $users;

    const CODE = [
        'first_name' => '[first_name]',
        'last_name'  => '[last_name]',
        'email'      => '[email]',
        'password'   => '[password]',
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users){
        return $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $users = $this->users;
        // $template = EmailTemplate::where('id', '1')->select('content')->get();
        // $body = $this->replaceContentEmail($template[0]->content);
        
        if($users['user_status'] == 'activate'){
            $template = EmailTemplate::where('id', '1')->select('content')->get();
            $body = $this->replaceContentEmail($template[0]->content);
        }else{
            $template = EmailTemplate::where('id', '3')->select('content')->get();
            $body = $this->replaceContentEmail($template[0]->content);
        }

        if($users['user_status'] == 'activate'){
            $template_sub = EmailTemplate::where('id', '1')->select('subject')->get();
            // $subject = "Congrates! Your account has been activated";
            $subject = $template_sub[0]->subject;
        }else{
            $template_sub = EmailTemplate::where('id', '3')->select('subject')->get();
            // $subject = "Oops! Your account has been deactivated";
            $subject = $template_sub[0]->subject;
        }
        return $this->view('emails.login-password-template')->subject($subject)->with(['content' => $body]);
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
                    case "email":
                    if($this->users){
                        $replace = $this->users['email'];
                    }
                    break;
                    case "password":
                    if($this->users){
                        $replace = $this->users['password'];
                    }
                    break;
                }
                $content = str_replace($value, $replace, $content);
            }
            return $content;
        }
    }

}
