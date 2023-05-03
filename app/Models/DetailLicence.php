<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLicence extends Model
{
    use HasFactory;

    protected $fillable = [
        'CodeDetailLicence',
        'serie',
        'codeDouane',
        'codePaysOrg',
        'quantite',
        'codeDevice',
        'prixUnit',
        'unitStat',
        'DateSaisie'
            ];
}
