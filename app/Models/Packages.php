<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $table = 'wd_packages';

    protected $guarded = ['id'];

    public function outlets()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, 'package_id');
    }
}
