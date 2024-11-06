@extends('layouts.master')
@section('css')
    {{-- toastr_css --}}

{{-- @section('title')
Color BLind Sight
@stop
@endsection --}}
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Admins Accounts
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


{{-- @if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif --}}



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
{{-- ============== زر الاضافة --}}
            <button type="button" class="button x-small rounded-10" data-toggle="modal" data-target="#exampleModal">
               New Admin
            </button>
            <br><br>
 {{-- ============== نهاية زر الاضافة --}}

  {{-- ============== جدول قائمة الحسابات --}}
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Phone</th> --}}
                            <th>Added At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($admins as $admin)
                            <tr>
                                <?php $i++; ?>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                {{-- <td>{{$admin->phone}}</td> --}}
                                <td>{{$admin->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm rounded-10" data-toggle="modal"
                                        data-target="#edit{{ $admin->id }}"
                                        title="Update"><i class="fa fa-edit"></i></button>

                                    @if (!($admin->id===session('user')->id))
                                    <button type="button" class="btn btn-danger btn-sm rounded-10" data-toggle="modal"
                                    data-target="#delete{{ $admin->id }}"
                                    title="Delete"><i
                                        class="fa fa-trash"></i></button>
                                    @endif

                                </td>
                            </tr>
      {{-- ============== زر تعديل الحسابات --}}
                            <!-- edit_modal_admin -->
                            <div class="modal fade" id="edit{{ $admin->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Update Admin Data
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit_form -->
                                            <form action="{{ route('admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf

                                                        <fieldset class="row" >
                                                            <input type="hidden" value="2" name="role_id">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                  <label for="name">Name</label>
                                                                  <input required type="text"  name="name" class="form-control" id="name" value="{{ $admin->name }}"  autofocus>
                                                                </div>
                                                            </div>

                                                              <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                  <label for="email"> Email </label>
                                                                  <input required  class="form-control" type="email" name="email" value="{{ $admin->email }}"  placeholder="your email"
                                                                    id="email">
                                                                </div>
                                                              </div>

                                                            {{-- <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="phone">Phone</label>
                                                                <input required  type="number" pattern="[0-9]*" class="form-control" name="phone" id="phone"
                                                                    placeholder="Ex.966123456789" value="{{ $admin->phone }}">
                                                                </div>
                                                            </div> --}}

                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="password"> Password </label>
                                                                <input required class="form-control" type="password" name="password" id="password">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="c_password"> Confirm Password </label>
                                                                <input required class="form-control" type="password" name="password_confirmation" id="c_password">
                                                                </div>
                                                            </div>

                                                        </fieldset>

                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary rounded-10"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-success rounded-10">Submit </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
           {{-- ============== نهاية تعديل الحسابات --}}
            {{-- ============== زر حذف الحسابات --}}

                            <!-- delete_modal_admin -->
                            <div class="modal fade" id="delete{{ $admin->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Delete Admin Account
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admins.destroy', $admin->id) }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                Are you sure you want to delete this account ?
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $admin->id }}">
                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary rounded-10"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-danger rounded-10">Submit </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                  {{-- ============== نهاية تعديل الحسابات --}}


                        @endforeach
                    </tbody>
                </table>
           {{-- ============== نهاية جدول قائمة الحسابات  --}}
            </div>
        </div>
    </div>
</div>


 {{-- ============== جزء إضافة حساب  --}}

<!-- add_modal_admin -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Admin Account
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <fieldset class="row" >
                        <input type="hidden" value="2" name="role_id">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input required type="text"  name="name" class="form-control" id="name" autofocus>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="email"> Email </label>
                              <input required class="form-control" type="email" name="email" placeholder="your email"
                                id="email">
                            </div>
                          </div>

                          {{-- <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="phone">Phone</label>
                              <input required  type="number" pattern="[0-9]*" class="form-control" name="phone" id="phone"
                                placeholder="Ex.966123456789">
                            </div>
                          </div> --}}

                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="password"> Password </label>
                              <input required class="form-control" type="password" name="password" id="password">
                            </div>
                          </div>

                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="c_password"> Confirm Password </label>
                              <input required class="form-control" type="password" name="password_confirmation" id="c_password">
                            </div>
                          </div>



                    </fieldset>

            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary rounded-10"
                    data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success rounded-10">Submit </button>
            </div>
            </form>

        </div>
    </div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
