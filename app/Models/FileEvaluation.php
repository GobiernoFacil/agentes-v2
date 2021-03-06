<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileEvaluation extends Model
{
    //
    public $table = 'filesEvaluation';

    protected $fillable = [
        'aspirant_id', 'institution','user_id','hasVideo','hasCv','hasLetter','hasEssay','hasProof','hasPrivacy'
    ];
}
