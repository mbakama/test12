<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class DetailDgm extends Model
{
    use HasFactory, FilterQueryString;
    protected $fillable = [
        "NumDGM",
        "Num",
        "Nom",
        "Postnon",
        "Sexe",
        "EtatCivil",
        "CodePays",
        "DateNais",
        "Profession",
        "CodTypeVisa",
        "LibellePaysAjout",
        "DatExpirationVisa",
        "CoNum",
        "DateSaisie",
        "Statut",
        "Annee"
    ];

    protected $filters = [
        "sort",
        "by",
        "NumDGM",
        "Num",
        "Nom",
        "Postnon",
        "Sexe",
        "EtatCivil",
        "CodePays",
        "DateNais",
        "Profession",
        "CodTypeVisa",
        "LibellePaysAjout",
        "DatExpirationVisa",
        "CoNum",
        "DateSaisie",
        "Statut",
        "Annee"
    ];
}