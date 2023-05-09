<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetailFPI extends Model
{
    use HasFactory;

    protected $fillable = ['numero',
'CodeSource',
'MontantCreditFc',
'MontantCreditUSD',
'Promoteur',
'AdressPromoteur',
'observation',
'Annee',
'CoNum',
'DateCreation',
'Status'];
}
