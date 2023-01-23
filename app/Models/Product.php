<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','description','quqatity','unit_price','amount']; 

    public function user(){

        return $this->belongsTo(User::class);

    }
}
