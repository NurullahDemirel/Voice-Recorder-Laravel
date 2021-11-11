<div class="card mt-2">
    <div class="card-header d-flex justify-between items-center">
        <span>{{$post->title}}</span>
            <form action="{{route('user.delete.post')}}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" value="{{$post->id}}" name="id">
                <button type="submit" class="bg-red-500 text-white p-2 rounded-lg">Delete</button>
            </form>
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="flex items-center space-x-2">
            <span> User Id: {{ $post->user->id }}</span>
            <span> User Name: {{ $post->user->name }}</span>
        </div>
    </div>
</div>
