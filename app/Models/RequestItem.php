<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    protected $table = ['request_items'];
    protected $fillable = ['request_id', 'item_id', 'quantity'];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
