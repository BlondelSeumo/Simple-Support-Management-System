<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends BackendController
{
    private $id;

    private $notDeleteArray = [1];

    public function __construct()
    {
        $this->data['notDeleteArray'] = $this->notDeleteArray;

        $this->middleware(['permission:user'])->only('index');
        $this->middleware(['permission:user_create'])->only('create', 'store');
        $this->middleware(['permission:user_edit'])->only('edit', 'update');
        $this->middleware(['permission:user_destroy'])->only('destroy');
        $this->middleware(['permission:user_show'])->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roleId = (int)$request->role;

        $this->data['users'] = [];
        if ($roleId) {
            $role = Role::find($roleId);
            if (!blank($role)) {
                $this->data['users'] = User::role($role->name)->get();
            }
        } else {
            $this->data['users'] = User::get();
        }
        $this->data['selectRoleID'] = $roleId;
        $this->data['roles']        = Role::get();

        return view('backend.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['roles'] = Role::get();
        return view('backend.user.create', $this->data);
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

        $user = new User;

        $user->name          = $request->name;
        $user->designation   = $request->designation;
        $user->email         = $request->email;
        $user->phone         = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->joining_date  = $request->joining_date;
        $user->address       = $request->address;
        $user->username      = $request->username;
        if ($request->password) {
            $user->password = Hash::make(request('password') ?? 123456);
        }
        $user->save();

        if (request()->file('image')) {
            $user->media()->delete();
            $user->addMedia(request()->file('image'))->toMediaCollection('user');
        }

        $role = Role::find($request->role);
        if (!blank($role)) {
            $user->assignRole($role->name);
        }

        return redirect(route('admin.user.index'))->withSuccess('The user added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['user'] = User::findOrfail($id);
        return view('backend.user.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user']  = User::findOrfail($id);
        $this->data['roles'] = Role::get();
        return view('backend.user.edit', $this->data);
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
        $user = User::findOrfail($id);

        $niceNames = [];
        $this->id  = $id;
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $user->name          = $request->name;
        $user->designation   = $request->designation;
        $user->email         = $request->email;
        $user->phone         = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->joining_date  = $request->joining_date;
        $user->address       = $request->address;
        $user->username      = $request->username;
        if ($request->password) {
            $user->password = Hash::make(request('password') ?? 123456);
        }
        $user->save();

        if (request()->file('image')) {
            $user->media()->delete();
            $user->addMedia(request()->file('image'))->toMediaCollection('user');
        }

        $role = Role::find($request->role);
        if (!blank($role)) {
            $user->syncRoles($role->name);
        }

        return redirect(route('admin.user.index'))->withSuccess('The user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            return redirect(route('admin.user.index'))->withError('You don\'t have permission to delete this data');
        }

        $user = User::findOrfail($id);
        $user->delete();
        return redirect(route('admin.user.index'))->withSuccess('The user deleted successfully');
    }

    private function validateArray()
    {
        return [
            'name'          => ['required', 'string', 'max:60'],
            'designation'   => ['required', 'string', 'max:60'],
            'email'         => ['required', 'string', Rule::unique("users", "email")->ignore($this->id), 'email', 'max:100'],
            'phone'         => ['required', 'string', 'max:60'],
            'date_of_birth' => ['required', 'string', 'max:60'],
            'joining_date'  => ['required', 'string', 'max:60'],
            'image'         => 'nullable|mimes:jpeg,jpg,png,gif|max:3096',
            'address'       => ['required', 'max:200'],
            'role'          => 'required|numeric|not_in:0',
            'username'      => ['required', 'string', Rule::unique("users", "username")->ignore($this->id), 'max:60'],
            'password'      => $this->id ? "nullable|min:6" : "required|min:6",
        ];
    }
}
