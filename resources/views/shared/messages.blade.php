{{-- session() 闪存数据; --}}

{{--首先定义 4 个键--}}
@foreach(['danger','warning','success','info'] as $msg)

    {{--has() 方法判断 session 中有没有给定键的值--}}
    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif

@endforeach
