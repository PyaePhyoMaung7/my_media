@extends('admin.layouts.app')

@section('content')
<div class="offset-1 col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin#categoryUpdate', $category['category_id'])}}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="categoryName" value='{{old('categoryName',$category['title'])}}' placeholder="Enter Category Name">
                    @error('categoryName')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label  class="form-label">Description</label>
                    <textarea class="form-control" name="categoryDescription"  rows="3" placeholder="Enter Category Description">{{old('categoryDescription',$category['description'])}}</textarea>
                    @error('categoryDescription')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <input type="submit" value="Update" class="btn btn-dark">
                <a href="{{route('admin#createCategory')}}"><input type="button" value="New" class="btn btn-dark"></a>

            </form>
        </div>
    </div>

</div>
<div class="col-6">
    @if (Session::has('createSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('createSuccess')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    @if (Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('deleteSuccess')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category List</h3>

        <div class="card-tools">
          <form action="{{route('admin#categorySearch')}}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="categorySearchKey" class="form-control float-right" value="{{$key}}" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category['category_id']}}</td>
                    <td>{{$category['title']}}</td>
                    <td>{{$category['description']}}</td>
                    <td>
                        <a href="{{route('admin#categoryEditPage', $category['category_id'])}}" class="text-decoration-none">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>


                    <a href="{{route('admin#deleteCategory', $category['category_id'])}}" class="text-decoration-none">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>

                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
