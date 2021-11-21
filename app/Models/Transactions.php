<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Transactions extends Model
{
    use HasFactory, Filterable, AsSource, Chartable;

    protected $table = 'wd_transactions';

    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function outlets()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, 'transaction_id');
    }
}
