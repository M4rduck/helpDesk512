<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;



class RoleController extends Controller
{   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $permissions = Permission::pluck('name','id');
        return view('admin.roles.index')->with(['permissions'=>$permissions]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();        
        ($input['special'] == 'null') ? $input['special'] = null : $input;
        // esto es un if ! lo que hace es mirar si el campo que pide la bd es null
        
        $roles = Role::create($input);
        $roles->permissions()->sync($request->get('permissions'));
        return response()->json([
            'success' => true,
            'message' => 'Role Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::with('permissions')->find($id);
        ($roles['special'] == null) ? $roles['special'] = 'null' : $roles;
        return  array ("roles"=>$roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $input = $request->all();
         ($input['special'] == 'null') ? $input['special'] = null : $input;
         $roles = Role::findOrFail($id);

         $roles->update($input);

         $roles->permissions()->sync($request->get('permissions'));

        return response()->json([
            'success' => true,
            'message' => 'Role Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::whereId($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rol Delete'
        ]); 
    }

    public function apiRoles()
    {
        $roles=Role::with('permissions')->get();
        $permissions = Role::with('permissions')->find($roles);
        
        return Datatables::of($roles)
            ->addColumn('action', function($roles){
                return '<td width="10px">
                            <button  class="btn btn-success btn-sm" 
                                onclick="editForm('. $roles->id .')">
                                <i class="far fa-edit"></i> Edit</button>
                          </td>' .
                          '<td width="10px">
                           <button class="btn btn-danger btn-sm" href="#"
                           onclick="deleteData('. $roles->id .')">
                            <i class="fas fa-trash"></i> 
                          Delete</button>  
                          </td>';
            })
            ->editColumn('description',function($roles){
                $desc = '';
                
                $desc = ''.$roles->description.'';   
                
                return $desc;
            })
            ->editColumn('edit', function($roles){
                return '<span class="label label-primary">'
                . $roles->special .'</span>';
            })
            ->rawColumns(['description'=>'description','edit' => 'edit', 'action' => 'action'])
            ->make(true); 
    }
}
