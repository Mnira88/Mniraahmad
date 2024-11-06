<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Hash;
use Validator;

class VisitorController extends Controller
{

    public function dashboard()
    {
        return view('visitors.dashboard');
    }

    public function profile($id)
    {
        $visitor = Visitor::findorFail($id);
        return view('visitors.profile', compact('visitor'));
    }

    public function index()
    {
        $visitors=Visitor::orderByDesc('id')->get();
        return view('visitors.index',compact('visitors'));
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
            'phone' =>'required|min:10|max:10|unique:visitors',
            'email'=>'required|email|unique:visitors,email',
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
        $input['role_id'] ='3';

        $visitor=Visitor::create($input);

        toastr()->success('User Added Successfully');
        return redirect()->back();
    }


    public function show(Visitor $visitor)
    {
        //
    }

    public function edit(Visitor $visitor)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'required',
            // 'role_id'=>'required',
            'phone' => ['required','min:10','max:10', Rule::unique('visitors')->ignore($id)],
            'email'=>['required','email',Rule::unique('visitors')->ignore($id)],
            // 'password'=>'required|confirmed|min:8',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            toastr()->error('Operation Failed');
            return redirect()->back()->withErrors($validator);
        }
        $visitor = Visitor::findOrFail($id);
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
        $visitor->update($input);
        toastr()->success('User Updated Successfully');

      return  redirect()->back();
    }


    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();
        toastr()->success('Accont Deleted Successfully');
        return redirect()->back();
    }
}
