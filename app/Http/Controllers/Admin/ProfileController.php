<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends BackendController
{
    private $id;

    public function index()
    {
        $this->data['user'] = auth()->user();
        return view('backend.profile.index', $this->data);
    }

    public function update(Request $request)
    {
        $niceNames = [];
        $this->id  = auth()->id();
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $user = auth()->user();

        $user->name          = $request->name;
        $user->designation   = $request->designation;
        $user->email         = $request->email;
        $user->phone         = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->joining_date  = $request->joining_date;
        $user->address       = $request->address;
        $user->username      = $request->username;
        if ($request->password) {
            $user->password = Hash::make(request('password'));
        }
        $user->save();

        if (request()->file('image')) {
            $user->media()->delete();
            $user->addMedia(request()->file('image'))->toMediaCollection('user');
        }
        return redirect(route('admin.profile.index'))->withSuccess('Your Profile Updated Successfully');
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
            'username'      => ['required', 'string', Rule::unique("users", "username")->ignore($this->id), 'max:60'],
            'password'      => $this->id ? "nullable|min:6" : "required|min:6",
        ];
    }
}
