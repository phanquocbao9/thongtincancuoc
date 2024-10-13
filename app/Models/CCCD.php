<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCCD extends Model
{
    use HasFactory;

    protected $table = 'cccd';
    protected $primaryKey = 'id_cccd';
    public $incrementing = false;
    protected $fillable = [
        'id_cccd', 'name_cccd', 'dob_cccd', 'sex_cccd', 'nationality_cccd',
        'home_cccd', 'address_cccd', 'features_cccd', 'issue_cccd', 'doe_cccd'
    ];

}
