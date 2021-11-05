<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Packages extends Model
{
    use HasFactory, Filterable;

    protected $table = 'wd_packages';

    protected $guarded = ['id'];

    protected $allowedFilters = [
        'package_type',
        'package_name'
    ];

    public function outlets()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, 'package_id');
    }
}
