<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class InstitutionPermission extends Model
{
    protected $fillable = ['institution_id','permission_id','crested_by','updated_by'];

    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id');
    }
}
