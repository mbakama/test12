<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class DetailLicence extends Model
{
    use HasFactory,SoftDeletes;

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
