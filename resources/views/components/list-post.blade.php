<div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($posts as $post)
        <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
            <img src="{{ asset('uploads').'/'.$post->image }}" alt="Imagen del post {{ $post->title }}">
        </a>
    @empty
        <p class="text-center">No hay posts, sigue a alguien para poder mostrar sus posts</p>
    @endforelse
    </div>
    
    <div class="my-10">
        {{ $posts->links() }}
    </div>
</div>