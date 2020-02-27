<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['product_name','quantity','price','category_id','description',
  'rate','available'];

  public function categories(){
    return $this->belongsTo(Category::class);
  }
}
