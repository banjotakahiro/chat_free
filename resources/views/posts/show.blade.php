<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        <article class="mb-2">
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words">
                {{ $post->title }}</h2>
            <h3>{{ $post->user->name }}</h3>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                <span
                    class="text-red-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $post->created_at ? 'NEW' : '' }}</span>
                {{ $post->created_at }}
            </p>
            <p class="text-gray-700 text-base">{!! nl2br(e($post->body)) !!}</p>
        </article>
        <div class="flex flex-row text-center my-4">
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
                </form>
            @endcan
        </div>
        {{-- <hr class="my-4"> --}}
        <section class="font-sans break-normal text-gray-900 ">
            @foreach ($comments as $comment)
                <div class="my-2 yourClickTarget">
                    <span class="infobox">
                        <span value="" class="font-bold mr-3 "
                            id="comment_id_{{ $loop->index }}">{{ $comment->comment_id }}</span>
                        <span class="font-bold mr-3 ">平泉を愛するもの</span>
                        <span class="text-sm ">{{ $comment->created_at }}</span>
                    </span>
                    <div class="hidden mention_box" id="mention_content_{{ $loop->index }}">
                                {{-- mention_idの取得の仕方を変更したい。向こうはcontroller内なのでこちらより融通がきく --}}
                        <div>
                            <ul>
                                <li>{{ $comment->mention_id_body_1 }}</li>
                                <li>{{ $comment->mention_id_body_2 }}</li>
                                <li>{{ $comment->mention_id_body_3 }}</li>
                            </ul>
                        </div>
                    </div>
                    <div id="show_box_{{ $loop->index }}"
                        class="bg-black text-white text-sm absolute p-2 rounded shadow-lg hidden">
                        ここに情報を表示します！！
                    </div>
                    <p>{!! nl2br(e($comment->body)) !!}</p>
                </div>
            @endforeach
        </section>
        <x-validation-errors :errors="$errors" />
        <x-flash-message :message="session('notice')" />
        <form action="{{ route('posts.comments.store', $post) }}" method="POST"
            class="rounded pt-3 pb-8 mb-4 flex flex-wrap">
            @csrf
            <div class="fixed bottom-0 w-3/4 md:w-1/3 mb-4 md:pr-2"> <!-- テキストエリアの横幅を7/8に設定 -->
                <textarea name="body" rows="2" id="yourInputField"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="本文">{{ old('body') }}</textarea>
            </div>
            <div class="fixed bottom-0 md:w-1/8"> <!-- 登録ボタンの横幅を1/8に設定 -->
                <input type="submit" value="コメント追加"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
</x-app-layout>
