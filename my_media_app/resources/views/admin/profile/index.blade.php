@extends('admin.layouts.app')

@section('content')

<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert start --}}
                @if(Session::has('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{Session::get('updateSuccess')}}</strong>
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- alert end --}}
                <form class="form-horizontal" method="post" action="{{route('admin#update')}}">
                    @csrf {{-- {{csrf_field()}} --}}
                    <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="adminName" class="form-control" id="inputName" placeholder="Enter Name..." value="{{old('adminName',$userData->name)}}">
                        @error('adminName')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="adminEmail" class="form-control" id="inputEmail" placeholder="Enter Email..." value="{{old('adminEmail',$userData->email)}}">
                        @error('adminEmail')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                        <input type="text" name="adminPhone" class="form-control" id="inputEmail" placeholder="Enter Phone Number..." value="{{$userData->phone}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <textarea name="adminAddress" id="" class="form-control" cols="30" rows="3" placeholder="Enter Address..." > {{$userData->address}} </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                        <select name="adminGender" class="form-control" id="">
                            <option value="">Choose Your Gender</option>
                            <option value="male" @if($userData->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if($userData->gender == 'female') selected @endif>Female</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn bg-dark text-white">Save</button>
                    </div>
                    </div>


                </form>

                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                    <a href="{{route('admin#directChangePassword')}}" class="text-decoration-none">Change Password</a>
                    </div>
                </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>



@endsection

