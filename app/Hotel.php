<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{

    protected $table = 'hotels';
    protected $fillable = ['name','user_id','location','logo'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
