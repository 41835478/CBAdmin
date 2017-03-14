<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','sort'];
    public function menus()
    {
        return $this->belongsToMany('App\Models\Menu','role_menu','role_id','menu_id')->orderBy('sort','desc');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User','user_role','role_id','user_id');
    }
}
