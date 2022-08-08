<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use PhpParser\Node\Stmt\TryCatch;


use DB;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    function __construct()
    {

        $this->middleware('role:Super-Admin|Admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id', 'DESC')->paginate(7);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return redirect()->route('permissions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:permissions',
        ]);

        if (Auth::user()->hasRole('Super-Admin')) {
            $permission = Permission::create(['name' => $request->input('name')]);
            $permission->assignRole('Super-Admin');
            $request->session()->flash('success', 'Permission created successfully');
            return redirect()->route('permissions.index');
        } else {
            $request->session()->flash('error', 'You do not have permission to create permission');
            return redirect()->route('permissions.index');
        }

        return redirect('/403');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        return redirect()->route('permissions.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('permissions', 'name')->ignore($id)
            ]
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    public function destroy($id)
    {
        DB::table("permissions")->where('id', $id)->delete();

        $notification = array(
            'message' => 'Permissions deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('permissions.index')
            ->with($notification);
    }
}
