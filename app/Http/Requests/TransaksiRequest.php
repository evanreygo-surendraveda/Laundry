<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_member' => 'required|exists:members,id',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date',
            'tgl_bayar' => 'required|date',
            'status' => 'required',
            'status_bayar' => 'required',
            'id_user' => 'required|exists:users,id'
        ];
    }
}
