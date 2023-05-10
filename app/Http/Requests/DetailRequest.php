<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'numero' => 'required',
            'CodeSource' => '',
            'MontantCreditFc' => 'required',
            'MontantCreditUSD' => 'required',
            'Promoteur' => '',
            'AdressPromoteur' => '',
            'observation' => '',
            'telephone' => '',
            'Annee' => 'required',
            'CoNum' => 'required',
            'DateCreation' => 'required',
            'Status' => 'required'
        ];
    }
}