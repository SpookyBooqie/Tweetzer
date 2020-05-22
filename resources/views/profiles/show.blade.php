@extends('components.master')

@section('content')
    <header class="mb-6 relative">
        <div class="relative">
        <img
            src="/images/banner.png"
            alt="profile banner"
            class="mb-2"
        >

        <img
            src="{{$user->avatar}}"
            alt=""
            class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
            style="left: 50%"
            width="150"
        >
        </div>

        <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px">
                <h2 class="font-bold text-2xl mb-0">{{$user->name}}</h2>
                <p class="text-sm">Joined {{$user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">

                @can('edit', $user)
                    <a href="{{$user->path('edit')}}" class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">Edit Profile</a>
                @endcan

                @if(current_user()->isNot($user))
                    <form method="POST" action="{{route('follow', $user->username)}}">
                        @csrf

                        <button type="submit"
                                class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs"
                        >
                            {{auth()->user()->following($user) ? 'Unfollow Me' : 'Follow Me'}}
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <p class="text-sm">
            Two things are infinite: the universe and human stupidity; and I'm not sure about the former.
        </p>

    </header>

    @include('_timeline', [
    'tweets' => $tweets
])
@endsection
