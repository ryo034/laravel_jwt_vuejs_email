<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
      $this->user = $user;
    }

    public function build()
    {
      return $this
      ->subject('仮登録が完了しました')
      ->view('auth.email.pre_register')
      ->with(['token' => $this->user->email_verify_token,]);
    }
}
