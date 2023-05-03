<?php

namespace App\Models;

use App\Models\Docteur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    /**
     * Get the docteurs that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docteurs(): BelongsTo
    {
        return $this->belongsTo(Docteur::class);
    }
}
