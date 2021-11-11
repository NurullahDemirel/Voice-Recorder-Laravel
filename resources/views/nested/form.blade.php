@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('ErrorMessage.errors')

                <form action="{{route('categories.store')}}" method="post">
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="border @error('email') border-red-700 @enderror">
                        <span class="text-red-600">@error('name'){{$message}} @enderror</span>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="name">Parent Category</label>
                        <select name="parenCategory" id="">
                            <option value="0">no category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                        <div>
                            <button type="submit" class="bg-green-300 text-white p-2 rounded-lg">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

