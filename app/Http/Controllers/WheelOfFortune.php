<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultWheelOfFortuneRequest;
use App\Mail\ResultWheelOfFortune;
use Illuminate\Support\Facades\Mail;

class WheelOfFortune extends Controller
{
    public function sendResult(ResultWheelOfFortuneRequest $request)
    {
        Mail::to('cronixtour@yandex.ru')->send(
            new ResultWheelOfFortune(
                $request->get('name'),
                $request->get('email'),
                $request->get('discount')
            )
        );

        return response()->json(null, 204);
    }
}
