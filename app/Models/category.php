<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// import 'User' model
use App\Models\User;

class category extends Model
{
    //use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];

    public function user_data()
    {
        // build Eloquent ORM - one to one relationship with category.user_id with users.id
        //return $this->hasOne(Model::class,'Model field name','Field name to be related');
        //Eloquent ORM Source and Target should be Model related, here Query builder not
        return $this->hasOne(User::class,'id','user_id');
    }
}
