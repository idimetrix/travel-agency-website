<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscription extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string|null
     */
    private $email;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $phone
     * @param string|null $email
     */
    public function __construct(string $name, string $phone, string $email = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newsletter-subscription')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->with([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email
            ]);
    }
}
