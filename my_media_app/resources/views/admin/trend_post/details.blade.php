@extends('admin.layouts.app')

@section('content')

<div class="col-6 offset-3">
    <div class="card">
        <div class="card-body">

            <span  onclick="history.back()" role="button">
                <i class="fa-solid fa-arrow-left text-dark fs-5"></i>
            </span>


            <div class="text-center">
                <img @if ($post['image'] !== null)
                    src="{{asset('postImage/'.$post['image'])}}"
                @else
                    src="{{asset('default_image/default_image.jpg')}}"
                @endif class="w-75 object-fit-cover rounded shadow-sm" alt="">
            </div>

            <h3 class="text-center my-3">{{$post['title']}}</h3>

            <p class="my-3">{{$post['description']}}</p>

            <div class="d-flex align-items-center mt-3">
                <span class="btn btn-dark rounded">{{$post['category_title']}}</span>
                <span class="ml-3"><i class="fa-solid fa-eye"></i> {{$viewCount}}</span>

            </div>
        </div>
    </div>

</div>

@endsection
