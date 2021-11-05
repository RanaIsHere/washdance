<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Outlets extends Model
{
    use HasFactory, Filterable;

    protected $table = 'wd_outlets';

    protected $guarded = ['id'];

    protected $allowedFilters = [
        'outlet_name',
        'outlet_address',
        'status'
    ];

    public function packages()
    {
        return $this->hasMany(Packages::class, 'outlet_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'outlet_id');
    }
}
