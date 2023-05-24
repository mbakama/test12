<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class DetailDgm extends Model
{
    use HasFactory, SoftDeletes, FilterQueryString;
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
    public function by($query, $value)
    { 
            return $query->where('NumDGM', $value)
            ->orWhere('Num', $value)
            ->orWhere('Nom', $value)
            ->orWhere('Postnon', $value)
            ->orWhere('Sexe', $value)
            ->orWhere('EtatCivil', $value)
            ->orWhere('CodePays', $value)
            ->orWhere('DateNais', $value)
            ->orWhere('Profession', $value);
        
         
    }
}