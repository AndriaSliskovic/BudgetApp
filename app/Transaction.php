<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Transaction extends Model
{
    public $fillable=['description','category_id','amount','user_ud'];
   public function category(){
      return $this->belongsTo('App\Category');
   }

   //Sa prefiksom scope sve iza njega je dostupno za pozivanje
   public function scopeByCategory($query, Category $category){
        if($category->exists){
            $query->where('category_id',$category->id);
        }
   }

   public function scopeByUser($query){
        if(Auth::user()){
             //Vraca id auth usera
            $query->where('user_id',auth()->id());
        }else{
            dd('nije ulogovan user');
        }
   }

//   public static function boot(){
//        static::addGlobalScope('user',function ($query){
//           $query->where('user_id',auth()->id());
//        });
//    }




}
