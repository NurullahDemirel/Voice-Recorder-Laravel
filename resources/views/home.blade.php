@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-2">Total Post:{{count($posts)}}</div>
            @include('ErrorMessage.errors')
            @foreach($posts as $post)
                @can('view',$post)
                    <x-user.user-component :post="$post" />
                @endcan
            @endforeach
        </div>
    </div>
</div>
@endsection
