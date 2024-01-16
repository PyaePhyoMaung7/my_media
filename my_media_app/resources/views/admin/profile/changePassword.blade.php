@extends('admin.layouts.app')

@section('content')

<div class="col-10 offset-2 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert start --}}
                @if(Session::has('oldPasswordError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{Session::get('oldPasswordError')}}</strong>
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- alert end --}}
                <form class="form-horizontal" method="post" action="{{route('admin#changePassword')}}">
                    @csrf {{-- {{csrf_field()}} --}}
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="oldPassword" class="form-control" id="inputName" placeholder="Enter Old Password...">
                            @error('oldPassword')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="newPassword" class="form-control" id="inputEmail" placeholder="Enter New Password..." >
                            @error('newPassword')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="confirmPassword" class="form-control" id="inputEmail" placeholder="Confirm New Password...">
                            @error('confirmPassword')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-3 col-3">
                            <button type="submit" class="btn bg-dark text-white">Change Password</button>
                        </div>

                    </div>


                </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>



@endsection

