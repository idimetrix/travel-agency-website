<?php

namespace App\Http\Requests\Consultation;

use App\Http\Requests\BaseStoreRequest;

class StoreConsultationRequest extends BaseStoreRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string'
        ];
    }
}
