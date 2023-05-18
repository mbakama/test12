<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Detailfp extends Model
{
    use HasFactory, SoftDeletes, FilterQueryString;

    protected $fillable = [
        'numero',
        'CodeSource',
        'MontantCreditFc',
        'MontantCreditUSD',
        'Promoteur',
        'AdressPromoteur',
        'observation',
        'telephone',
        'Annee',
        'CoNum',
        'DateCreation',
        'Status'
    ];
    protected $filters = [
        'sort',
        'by',
        'id',
        'numero',
        'CodeSource',
        'MontantCreditFc',
        'MontantCreditUSD',
        'Promoteur',
        'AdressPromoteur',
        'observation',
        'telephone',
        'Annee',
        'CoNum',
        'DateCreation',
        'Status'
    ];

    public function by($query, $value)
    {
        return $query->where('numero', $value)
            ->orWhere('CodeSource', $value)
            ->orWhere('Promoteur', $value)
            ->orWhere('AdressPromoteur', $value)
            ->orWhere('observation', $value)
            ->orWhere('telephone', $value)
            ->orWhere('Annee', $value)
            ->orWhere('DateCreation', $value)
            ->orWhere('CoNum', $value);


    }


}