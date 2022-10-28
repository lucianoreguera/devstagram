@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads').'/'.$post->image }}" alt="Imagen del post {{ $post->title }}">
            <div class="p-3">
                <p>0 Likes</p>
            </div>
            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->description }}</p>
            </div>

            @auth
            @if ($post->user->id === auth()->user()->id )
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <input 
                    type="submit" 
                    value="Eliminar Publicación"
                    class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold cursor-pointer mt-5"
                >
            </form>
            @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                
                @if (session('msg'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase">
                    {{ session('msg') }}
                </div>
                @endif

                <form action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un Comentario
                        </label>
                        <textarea id="comment" name="comment" placeholder="Agrega un comentario a la publicación" class="border p-3 w-full rounded-lg @error('comment') 
                            border-red-500
                        @enderror"></textarea>
                        @error('comment')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-center text-sm p-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
    
                    <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
                @endauth

                <div class="bg-white shadow mb-5 mt-10 max-h-96 overflow-y-scroll">
                   @forelse ($post->comments as $comment)
                    <div class="p-5 border-gray-300 border-b">
                        <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">{{ $comment->user->username }}</a>
                        <p>{{ $comment->comment }}</p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    @empty
                    <p class="p-10 text-center">Ho Hay Comentarios Aún</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection