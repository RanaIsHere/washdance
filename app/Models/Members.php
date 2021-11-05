<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Members extends Model
{
    use HasFactory, Filterable;

    protected $table = 'wd_members';

    protected $guarded = ['id'];

    protected $allowedFilters = [
        'member_name',
        'member_phone',
        'gender'
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'member_id');
    }
}
