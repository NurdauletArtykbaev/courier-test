<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'from_city_id',
        'to_city_id',
        'delivery_date',
        'user_id',
        'status',
        'comment',
        'parent_id',
    ];

    public function from()
    {
        return $this->belongsTo(City::class, 'from_city_id', 'id');
    }
    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo(City::class, 'to_city_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concatOrders()
    {
        return $this->hasMany(self::class,'parent_id');
    }
}
