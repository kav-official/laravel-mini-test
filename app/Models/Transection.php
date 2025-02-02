<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;
    protected $fillable = [
        "tran_id",
        "product_id",
        "type",
        "description",
        "quantity",
        "price"];
}
