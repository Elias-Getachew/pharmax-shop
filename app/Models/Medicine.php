<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
     protected $fillable = ['name', 'category_id', 'supplier_id', 'quantity', 'expiry_date', 'price', 
        'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    // protected $casts = [
    //     'expiry_date' => 'date',  // Cast expiry_date as a date
    // ];
}
