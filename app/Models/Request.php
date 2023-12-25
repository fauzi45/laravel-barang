<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    protected $table = 'requests';
    protected $fillable = ['employee_id', 'request_date', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class, 'request_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'request_items', 'request_id', 'item_id')
                    ->withPivot('quantity');
    }
}
