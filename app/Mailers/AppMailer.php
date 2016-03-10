<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class AppMailer{

    protected $mailer;
    protected $from='byc@example.com';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendPurchaseConfirmationTo(User $user, $purchases)
    {
        $this->to = $user->email;
        $this->view = 'emails.confirmPurchase';
        $this->subject = 'Purchase Confirmation';
        $this->data = compact('purchases');

        $this->deliver();
    }

    public function sendEmailConfirmationTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.confirmEmail';
        $this->subject = 'Email Confirmation';
        $this->data = compact('user');

        $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){
            $message->from($this->from, 'Book Your Class')
                    ->to($this->to)
                    ->subject($this->subject);
        });
    }
}