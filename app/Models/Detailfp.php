<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detailfp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['numero',
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
'Status'];

}
