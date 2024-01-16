@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td class="align-middle">{{$post['post_id']}}</td>
                    <td class="align-middle">{{$post['title']}}</td>
                    <td>
                        <img @if ($post['image'] !== null)
                                src="{{asset('postImage/'.$post['image'])}}"
                            @else
                                src="{{asset('default_image/default_image.jpg')}}"
                            @endif style="width:100px; height:70px" class="object-fit-cover rounded shadow-sm" alt="">
                    </td>
                    <td class="align-middle"><i class="fa-solid fa-eye"></i> {{$post['view_count']}}</td>
                    <td class="align-middle">
                        <a href="{{route('admin#trendPostDetails',$post['post_id'])}}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></button>
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
    <div class="d-flex justify-content-end">
        {{-- {{$posts->onEachSide(2)->links()}} --}}
    </div>
  </div>
@endsection
