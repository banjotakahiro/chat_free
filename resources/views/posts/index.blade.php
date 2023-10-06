<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <x-flash-message :message="session('notice')" />
        
        <form action="{{ route('posts.index') }}" method="GET">
            @csrf
            <input type="text" name="keyword">
            <input type="submit" value="検索">
        </form>

        <div class="-mx-1 lg:-mx-4 mb-4 mt-10">
            @foreach ($posts as $post)
                <article class="w-full h-auto px-4 text-xl text-gray-800">
                    <div class="w-full inset-x-0 top-0 h-1 bg-black"></div>
                    <a href="{{ route('posts.show', $post) }}">
                        <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words">{{ $post->title }}</h2>
                        <h3>{{ $post->user->name }}</h3>
                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            <span class="text-red-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $post->created_at ? 'NEW' : '' }}</span>
                            {{ $post->created_at }}
                        </p>
                        {{-- <img class="w-full mb-2" src="{{ $post->image_url }}" alt=""> --}}
                        <p class="text-gray-700 text-base">{{ Str::limit($post->body, 50) }}</p>
                    </a>
                    <a href="{{ route('posts.warnings.index',$post) }}">このスレッドを通報する</a>
                </article>
            @endforeach
                <div class="w-full inset-x-0 bottom-0 h-1 bg-black px-4"></div>
        </div>
        {{ $posts->links() }}
    </div>
</x-app-layout>
