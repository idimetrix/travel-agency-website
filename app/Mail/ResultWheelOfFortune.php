<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResultWheelOfFortune extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $discount;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $discount
     */
    public function __construct(string $name, string $email, string $discount)
    {
        $this->name = $name;
        $this->email = $email;
        $this->discount = $discount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.result-wheel-of-fortune')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'discount' => $this->discount
            ]);
    }
}
