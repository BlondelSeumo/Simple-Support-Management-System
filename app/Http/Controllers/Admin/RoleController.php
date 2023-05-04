<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends BackendController
{
    private $id;
    private $notDeleteArray = [1,2,3];

    function __construct() {
        $this->data['notDeleteArray'] = $this->notDeleteArray; 

        $this->middleware(['permission:role'])->only('index');
        $this->middleware(['permission:role_create'])->only('create', 'store');
        $this->middleware(['permission:role_edit'])->only('edit', 'update');
        $this->middleware(['permission:role_destroy'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['roles'] = Role::latest()->get();
        return view('backend.role.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $niceNames = [];
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $role       = new role;
        $role->name = $request->name;
        $role->save();

        return redirect(route('admin.role.index'))->withSuccess('The role Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['role'] = Role::findOrfail($id);
        return view('backend.role.edit', $this->data);
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
        $role = Role::findOrfail($id);

        $niceNames = [];
        $this->id  = $id;
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $role->name = $request->name;
        $role->save();

        return redirect(route('admin.role.index'))->withSuccess('The role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!in_array($id, $this->notDeleteArray)) {
            $role = Role::findOrfail($id);
            $role->delete();
            return redirect(route('admin.role.index'))->withSuccess('The role deleted successfully.');
        } else {
            return redirect(route('admin.role.index'))->withError('The role can\'t be delete.');
        }
    }

    private function validateArray()
    {
        return [
            'name' => ['required', 'string', Rule::unique("roles", "name")->ignore($this->id), 'max:100'],
        ];
    }
}
