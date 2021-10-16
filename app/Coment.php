<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    //
    protected $fillable = [
    	'post_id',
    	'user_id',
    	'koment'];
    public function post(){
    	return $this->belongsTo(Blog::class);
    }
}
