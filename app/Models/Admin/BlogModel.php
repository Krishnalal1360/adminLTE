<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Database\Factories\Admin\BlogFactory;
//use Laravel\Sanctum\HasApiTokens;


class BlogModel extends Model
{
    //
    use HasFactory, Notifiable;
    //
    protected $table = 'blogs';
    //
    protected $fillable = [
        //'uid',
        'title',
        'description',
        'file',
    ];
    //
    protected $hidden = [
        //'uid',
        //'file',
    ];
    //
    public static function newFactory(){
        //
        return BlogFactory::new();
    }
    //
    /*public function user(){
        //
        return $this->belongsTo(UserModel::class, 'uid', 'id');
    }*/
}
