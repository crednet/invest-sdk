<?php

namespace Credpal\CPInvest\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenure extends Model
{
    use SoftDeletes;

    protected $table = 'cp_invest_tenures';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['id', 'days', 'percentage', 'minimum', 'deactivated'];
}
