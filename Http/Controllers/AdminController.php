<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Hash;
use Validator;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admins.dashboard');
    }

    public function profile($id)
    {
        $admin = Admin::findorFail($id);
        return view('admins.profile', compact('admin'));
    }

    public function index()
    {
        $admins=Admin::orderByDesc('id')->get();
        return view('admins.index',compact('admins'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules=[
            'name'=>'required',
            // 'role_id'=>'required',
            'email'=>'required|email|unique:admins,email',
           // 'password'=>'required|confirmed|min:8',
           'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                // ->uncompromised()
        ],
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            toastr()->error('Operation Failed');
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $input['role_id'] ='1';

        $admin=Admin::create($input);

        toastr()->success('User Added Successfully');
        return redirect()->back();
    }


    public function show(Admin $admin)
    {
       //
    }


    public function edit(Admin $admin)
    {
        //
    }


    public function update(Request $request,$id)
    {
        $rules=[
            'name'=>'required',
            // 'role_id'=>'required',
            // 'email'=>'required|email|unique:admins,email',
            'email'=>['required','email',Rule::unique('admins')->ignore($id)],
            // 'password'=>'required|confirmed|min:8',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            toastr()->error('Operation Failed');
            return redirect()->back()->withErrors($validator);
        }
        $admin = Admin::findOrFail($id);
        $input = $request->except('password');
        if($request->password)
        {
            $passrules=[
                // 'password'=>'required|confirmed|min:8',
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        // ->uncompromised()
                ],
            ];
            $validator = Validator::make($request->all(),$passrules);
            if ($validator->fails()) {
                toastr()->error('Operation Failed');
                return redirect()->back()->withErrors($validator);
            }
          $input['password'] = Hash::make($request->password);
        }
        $admin->update($input);
        toastr()->success('User Updated Successfully');

      return  redirect()->back();
    }


    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        toastr()->success('Accont Deleted Successfully');
    }
}
