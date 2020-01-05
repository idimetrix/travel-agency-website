<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeToNewsletterRequest;
use App\Mail\NewsletterSubscription;
use Illuminate\Support\Facades\Mail;

class NewsletterSubscriptionController extends Controller
{
    public function subscribe(SubscribeToNewsletterRequest $request)
    {
        Mail::to('cronixtour@yandex.ru')->cc(['sitetour@cronix.ms'])->send(
            new NewsletterSubscription(
                $request->get('name'),
                $request->get('phone'),
                $request->get('email')
            )
        );

        return response()->json(null, 204);
    }
}
