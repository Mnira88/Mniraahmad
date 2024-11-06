<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Manager;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Validator;
use Hash;

class AuthController extends Controller
{

    public function loginpage()
    {
        return view('login.login');
    }

    public function activatepage()
    {
        return view('login.activate');
    }

    public function forgetpage()
    {
        return view('login.forget');
    }

    public function visitorRegisternpage()
    {
        return view('login.visitor_register');
    }

    public function managerRegisternpage()
    {
        return view('login.manager_register');
    }


     //  تابع يعيد اسم ال guard
     public function checkGuard($request){

        if($request->type == '1'){
            $guardName= 'admin';
        }
        elseif ($request->type == '2'){
            $guardName= 'manager';
        }
        elseif ($request->type == '3'){
            $guardName= 'visitor';
        }
        else{
            $guardName= 'null';
        }
        return $guardName;
    }

    // تابع يقوم بالتوجيه إلى لوحة التحكم حسب  نمط الدخول
public function redirectdashboard(Request $request)
{

   if($request->type == '1'){
       session(['user'=>Auth::guard('admin')->user()]);
       return redirect()->route('admin.dashboard');

   }
   if($request->type == '2'){
        session(['user'=>Auth::guard('manager')->user()]);
       return redirect()->route('manager.dashboard');
   }
   elseif ($request->type == '3'){
       session(['user'=>Auth::guard('visitor')->user()]);
       return redirect()->route('visitor.dashboard');

   }

}

public function dashboard()
{
    if(Auth::guard('admin')->check())
       return view('admins/dashboard');
      elseif(Auth::guard('manager')->check())
         return view('managers/dashboard');
       elseif(Auth::guard('visitor')->check())
       return view('visitors/dashboard');
}

public function login(Request $request)
  {
     if (Auth::guard($this->checkGuard($request))->attempt(['email' =>$request->email,'password'=>$request->password,'status'=>1]))
     {
            toastr()->success('Welcome Back');
            return $this->redirectdashboard($request);
     }
     elseif (Auth::guard($this->checkGuard($request))->attempt(['email' =>$request->email,'password'=>$request->password,'status'=>0]))
     {
            toastr()->success('Please Activate your account');
            return redirect()->route('activate.show');
     }
     else
     {
        toastr()->error('Login Failed');
         return redirect()->back();
     }

 }

 public function managerRegister(Request $request)
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

        $code = mt_rand(10000, 99999);
        $input['code'] =$code;

        $manager=Manager::create($input);

        // ========================

        // $code = mt_rand(10000, 99999);
        // $manager['code']=$code;
        // $manager->save();
        $message1="your Verification code is  : ".$code;
        $aaa= trim($manager->email);


        Mail::raw(  $message1,function ($m)  use ($aaa,$message1)  {
            $m->to($aaa);
            $m->setBody($message1);
            $m->subject('Emotin Detection - Activation Code');
            $m->from('info@emotion.com', 'Emotin Site');
          });
        // ===============================

        toastr()->success('User Added Successfully');
        return redirect()->route('login.show');
    }

    public function visitor_register(Request $request)
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

        $code = mt_rand(10000, 99999);
        $input['code'] =$code;

        $visitor=Visitor::create($input);

         // ========================

        //  $code = mt_rand(10000, 99999);
        //  $user['code']=$code;
        //  $user->save();
         $message1="your Verification code is  : ".$code;
         $aaa= trim($visitor->email);


         Mail::raw(  $message1,function ($m)  use ($aaa,$message1)  {
             $m->to($aaa);
             $m->setBody($message1);
             $m->subject('Emotin Detection - Activation Code');
             $m->from('info@emotion.com', 'Emotin Site');
           });
         // ===============================

        toastr()->success('User Added Successfully');
        return redirect()->route('login.show');
    }

 public function logout(Request $request,$type)
 {
     //  return $type;

     Auth::guard($type)->logout();

     $request->session()->invalidate();

     $request->session()->regenerateToken();
     toastr()->success('Good Bye');
     return redirect('/');
 }

 function newpassword(Request $request) {

    $rules=[
        'email' => 'required',
        'type' => 'required',
    ];
     if($request->type==2)
     {
        $user=Manager::where('email',trim($request->email))->first();
     }
     elseif($request->type==3)
     {
        $user=Visitor::where('email',trim($request->email))->first();
     }

    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        toastr()->error('Operation Failed');
        return redirect()->back()->withErrors($validator);
    }

    if($user)
    {

        $code = mt_rand(10000000, 99999999);
        // $user['code']=$code;
        $user['password']=bcrypt($code);
        $user->save();
        $message1="your New Password is  : ".$code;
        $aaa= trim($user->email);


        Mail::raw(  $message1,function ($m)  use ($aaa,$message1)  {
            $m->to($aaa);
            $m->setBody($message1);
            $m->subject('Emotin Detection - New Password');
            $m->from('info@emotion.com', 'Emotin Site');
          });


          toastr()->success('New password was sended to your email');
          return redirect()->route('login.show');
    }
    else
    {
        toastr()->error('Invaled Email');
        return redirect()->back();

    }

}
    public function verify(Request $request)
    {
        $rules = [
                'code' => 'required',
                'email' => 'required',
                'type' => 'required',
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails())
             {
                return  response()->json([ 'status' =>0,$validator->errors()->toJson()],400);
             }

            if($request->type==2)
             {
                $user = Manager::where('email',$request->email)->where('status',0)->first();
             }
            elseif($request->type==3)
             {
                $user = Visitor::where('email',$request->email)->where('status',0)->first();
             }

               if($user)
               {
                 if($user->code==$request->code)
                 {
                     $user['status']=1;
                     $user['code']=null;
                     $user->save();
                     toastr()->success('User Activated Successfully');
                     return redirect()->route('login.show');
                     }
                     else
                     {
                        toastr()->error('Invalid email or code');
                        return redirect()->back();
                     }

               }
               else
               {
                toastr()->success('Invalid email or code ');
                return redirect()->back();
               }
    }





}
