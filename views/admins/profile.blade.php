@extends('layouts.master')

{{-- ================ --}}


{{-- ================== --}}

@section('css')

{{-- @section('title')
Color BLind Sight
@stop --}}
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Profile
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
     <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           <div class="container">

             <form action="{{ route('admins.update',session('user')->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('patch') }}
                           @csrf

                            {{-- <fieldset class="row" > --}}
                                <div class="card-body">

                                <section >
                                    <div class="row">
                                        {{-- <div class="col-lg-4">
                                            <div class="card mb-4">
                                                <div class="card-body text-center" >
                                                    <img src="{{URL::asset('uploaded_images/admins/'.$admin->image)}}"
                                                         alt="avatar"
                                                         class="rounded-circle img-fluid" style="width: 150px;" id="image">
                                                    <h5 style="font-family: Cairo" class="my-3">{{$admin->firstname}} {{$admin->lastname}}</h5>
                                                    <p class="text-muted mb-1">{{$admin->email}}</p>

                                                    <input type="file"  accept="image/*" name="image"
                                                    class="form-control" id="image" onchange="loadFile(event)"  >

                                                    <script>
                                                        var loadFile = function(event) {
                                                            var image = document.getElementById('image');
                                                            image.src = URL.createObjectURL(event.target.files[0]);
                                                            main_image.onload = function() {
                                                            URL.revokeObjectURL(image.src) // free memory
                                                            }
                                                        };
                                                    </script>


                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            {{-- <div class="card mb-4"> --}}
                                                <div class="card-body">
                                                    <fieldset class="row" >
                                                        {{-- <input required type="hidden" name="role_id" class="form-control" value="{{ $admin->role_id }}" id="role_id"> --}}

                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="name">Name</label>
                                                              <input required type="text"  name="name" class="form-control" id="name" value="{{ $admin->name }}"  autofocus>
                                                            </div>
                                                        </div>

                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="email"> Email </label>
                                                              <input required  class="form-control" type="email" name="email" value="{{ $admin->email }}"  placeholder="Ex. pat@example.com"
                                                                id="email">
                                                            </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="password"> Password </label>
                                                              <input  class="form-control" type="password" name="password"   id="password" placeholder="password">
                                                            </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="c_password"> Confirm Password </label>
                                                              <input  class="form-control" type="password" name="password_confirmation"   id="c_password" placeholder="Confirm password">
                                                            </div>
                                                          </div>
                        {{-- ===================أمر إظهار كلمة المرور --}}


                                                          <div class="col-sm-12 col-md-6">

                                                            <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                                                   id="exampleCheck1"  style="margin-left: 10px;margin-right: 10px">
                                                            <label class="" for="exampleCheck1"
                                                                  style="margin-left: 30px;margin-right: 30px">Show Password </label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </section>


                            {{-- </fieldset> --}}




             </div>
                                            <center>
                                                <button type="submit" class=" mt-3 px-5 btn btn-info shadow rounded-10">
                                                    Submit
                                                </button>
                                                &nbsp;&nbsp;&nbsp;
                                                <a class=" shadow btn px-5 mt-3 text-white btn-success  px-3 s-rounded rounded-10" href="{{url()->previous()}}"> Close </a>
                                            </center>
             </form>

         </div>
     </div>
  </div>
 </div>
           {{-- ============== نهاية تعديل الملف الشخصي --}}


            </div>


<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

 {{-- ==============كود عرض الصورة بعد اختيارها في أداة الصور --}}

</div>

{{-- ==============نهاية جزء الصورة --}}


{{-- ====كود تحويل نوع عنصر الباسوورد --}}
<script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("c_password");
            if ((x.type === "password")&&(y.type === "password")){
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
@endsection
