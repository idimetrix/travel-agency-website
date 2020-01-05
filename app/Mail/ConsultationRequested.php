<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultationRequested extends Mailable
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
     * @var string
     */
    private $messageBody;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $phone
     * @param string $messageBody
     */
    public function __construct(string $name, string $phone, string $messageBody)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->messageBody = $messageBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.consultation')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->with([
                'name' => $this->name,
                'phone' => $this->phone,
                'message_body' => $this->messageBody
            ]);
    }
}
