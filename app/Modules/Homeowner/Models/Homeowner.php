<?php

namespace App\Modules\Homeowner\Models;

use App\Modules\Homeowner\Traits\ParsesHomeownerNamesTrait;
use Database\Factories\HomeownerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeowner extends Model {

    use HasFactory;
    use ParsesHomeownerNamesTrait;

    public $timestamps = false;

    protected static function newFactory(): HomeownerFactory
    {
        return HomeownerFactory::new();
    }
}
