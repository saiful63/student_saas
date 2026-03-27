<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\InstitutionPermission;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class InstitutionController extends Controller
{
    public function indexInstitution(){
        $permissions = Permission::pluck('name','id');
        return Inertia::render('Institution/IndexInstitution',[
            'permissions'=>$permissions
        ]);
    }

    public function createInstitution(Request $request){
        $validatedData = $request->validate([
            'name'=>['required'],
            'address'=>['required'],
            'selectedPermissions'=>['required']
        ]);
        extract($validatedData);
        $institution = Institution::create([
            'name'=>$name,
            'address'=>$address
        ]);
        
        $institution_data = [];
        foreach($selectedPermissions as $item=>$data){
            $institution_data[] = [
                'institution_id' => $institution?->id,
                'permission_id'  => $data,
                'created_by'     => Auth::id(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }
        InstitutionPermission::insert($institution_data);
        
    }
    public function listInstitution(){
        $institutions = Institution::all();
        return Inertia::render('Institution/InstitutionList',[
            'institutions'=>$institutions
        ]);
    }
}
