<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Hash;
use Validator;

class ManagerController extends Controller
{

    public function dashboard()
    {
        return view('managers.dashboard');
    }

    public function profile($id)
    {
        $manager = Manager::findorFail($id);
        return view('managers.profile', compact('manager'));
    }

    public function index()
    {
        $managers=Manager::orderByDesc('id')->get();
        return view('managers.index',compact('managers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules=[
            'name'=>'required',
            'hospital'=>'required',
            'phone' =>'required|min:10|max:10|unique:managers',
            'email'=>'required|email|unique:managers,email',
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
        $input['role_id'] ='2';

        $manager=Manager::create($input);

        toastr()->success('User Added Successfully');
        return redirect()->back();
    }


    public function show(Manager $manager)
    {
        //
    }


    public function edit(Manager $manager)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'required',
            'hospital'=>'required',
            'phone' => ['required','min:10','max:10', Rule::unique('managers')->ignore($id)],
            'email'=>['required','email',Rule::unique('managers')->ignore($id)],
            // 'password'=>'required|confirmed|min:8',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            toastr()->error('Operation Failed');
            return redirect()->back()->withErrors($validator);
        }
        $manager = Manager::findOrFail($id);
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
        $manager->update($input);
        toastr()->success('User Updated Successfully');

      return  redirect()->back();
    }


    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();
        toastr()->success('Accont Deleted Successfully');
        return redirect()->back();
    }
}
