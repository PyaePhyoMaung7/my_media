@extends('admin.layouts.app')

@section('content')
<div class="offset-1 col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin#createPost')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="postTitle" value='{{old('postTitle')}}' placeholder="Enter Post Title">
                    @error('postTitle')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label  class="form-label">Description</label>
                    <textarea class="form-control" name="postDescription"  rows="3" placeholder="Enter Post Description">{{old('postDescription')}}</textarea>
                    @error('postDescription')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="postImage" value='{{old('postImage')}}'>
                    @error('postImage')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="postCategory" id="" class="form-control">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category )
                            <option value="{{$category->category_id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('postCategory')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <input type="submit" value="Create" class="btn btn-dark">
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

    @if (Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('updateSuccess')}}</strong>
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
        <h3 class="card-title">Post List</h3>

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
              <th>Post Title</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
                <tr >
                    <td class="align-middle">{{$post['post_id']}}</td>
                    <td class="align-middle">{{$post['title']}}</td>
                    <td class="align-middle">
                        <img @if ($post['image'] !== null)
                                src="{{asset('postImage/'.$post['image'])}}"
                            @else
                                src="{{asset('default_image/default_image.jpg')}}"
                            @endif style="width:100px; height:70px" class="object-fit-cover rounded shadow-sm" alt="">
                    </td>
                    <td class="align-middle">
                        <a href="{{route('admin#updatePostPage', $post['post_id'])}}" class="text-decoration-none">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>


                    <a href="{{route('admin#deletePost', $post['post_id'])}}" class="text-decoration-none">
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
