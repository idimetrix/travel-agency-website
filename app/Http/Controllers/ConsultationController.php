<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consultation\StoreConsultationRequest;
use App\Mail\ConsultationRequested;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function store(StoreConsultationRequest $request)
    {
        Mail::to('cronixtour@yandex.ru')->cc(['sitetour@cronix.ms'])->send(
            new ConsultationRequested(
                $request->get('name'),
                $request->get('phone'),
                $request->get('message')
            )
        );

        return response()->json(null, 204);
    }
}
