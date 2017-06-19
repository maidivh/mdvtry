{{--用户头像和用户名页面--}}

<a href="{{ route('users.show',$user->id) }}">
    <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar">
</a>
<h1>{{ $user->name }}</h1>
<a href="#{{ $user->name.$user->id }}"></a>