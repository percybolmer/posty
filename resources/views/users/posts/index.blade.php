@extends('layouts.app')


@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <div class="w-8/12">
                <h1 class="text-2xl font-medium mb-1">
                    {{ auth()->user()->username}}
                </h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count()}} likes</p>
            </div>


            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post="$post"/>
                    @endforeach

                    {{ $posts->links()}}
                @else
                    <p>User has no posts</p>
                @endif
            </div>
        </div>
    </div>
@endsection