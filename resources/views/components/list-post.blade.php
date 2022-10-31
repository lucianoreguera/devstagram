<div>
    @forelse ($posts as $post)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
            <img src="{{ asset('uploads').'/'.$post->image }}" alt="Imagen del post {{ $post->title }}">
        </a>
    </div>
    <div class="my-10">
        {{ $posts->links() }}
    </div>
    @empty
    <p class="text-center">No hay posts, sigue a alguien para poder mostrar sus posts</p>
    @endforelse
</div>