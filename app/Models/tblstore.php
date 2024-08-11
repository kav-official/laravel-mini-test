<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblstore extends Model
{
    use HasFactory;
    protected $fillable = ["name","image","quantity","base_price","sale_price","created_at"];
}
