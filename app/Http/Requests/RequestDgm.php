<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestDgm extends FormRequest
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
            "NumDGM"=>'required|numeric',
            "Num"=>'required|numeric',
            "Nom"=>'alpha|nullable',
            "Postnon"=>'alpha|nullable',
            "Sexe"=>'numeric|nullable',
            "EtatCivil"=>'alpha|nullable',
            "CodePays"=>'numeric|nullable',
            "DateNais"=>'date_format:dateTime|nullable',
            "Profession"=>'alpha|nullable',
            "CodTypeVisa"=>'numeric|nullable',
            "LibellePaysAjout"=>'alpha|nullable',
            "DatExpirationVisa"=>'date_format:dateTime|nullable',
            "CoNum"=>'numeric|nullable',
            "DateSaisie"=>'date_format:dateTime|nullable',
            "Statut"=>'boolean',
            "Annee"=>'string'
        ];
    }
}
