@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    <div class="text-center mb-10">
        <h2 class="serif-tj text-2xl font-black text-cyan-950 uppercase tracking-wider">Панели идоракунии сомона</h2>
        <p class="text-xs text-amber-600 font-bold uppercase tracking-widest mt-1">Хуш омадед, Администратор!</p>
    </div>

    @if(session('success')) 
        <div class="mb-6 p-4 bg-emerald-800 text-white text-xs font-bold rounded-xl shadow-md border-l-4 border-amber-400">
            {{ session('success') }}
        </div> 
    @endif

    <div class="grid md:grid-cols-3 gap-8 items-start">
        <div class="md:col-span-2 bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">
            <h3 class="serif-tj text-md font-bold text-cyan-950 mb-4 uppercase border-b pb-2 tracking-wide">Иловакунии мақолаи нав</h3>
            
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Сарлавҳа:</label>
                    <input type="text" name="title" required class="w-full border border-gray-200 p-2.5 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Матни мақола:</label>
                    <textarea name="content" rows="6" required class="w-full border border-gray-200 p-2.5 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-sm transition"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Расми мақола (формати расм):</label>
                    <input type="file" name="image" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-950 file:text-amber-400 hover:file:bg-cyan-900 cursor-pointer">
                </div>
                <button type="submit" class="bg-cyan-950 hover:bg-cyan-900 text-amber-400 text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-xl shadow cursor-pointer transition">Чоп кардан</button>
            </form>
        </div>

        <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">
            <h3 class="serif-tj text-md font-bold text-cyan-950 mb-4 uppercase border-b pb-2 tracking-wide">Мақолаҳои чопшуда</h3>
            <div class="space-y-3 max-h-[400px] overflow-y-auto pr-1">
                @forelse($posts as $post)
                    <div class="border-b border-gray-100 pb-3 flex justify-between items-center gap-2">
                        <div>
                            <h4 class="font-bold text-xs text-cyan-950 line-clamp-1">{{ $post->title }}</h4>
                            <span class="text-[9px] text-gray-400">{{ $post->created_at->format('d.m.Y') }}</span>
                        </div>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[10px] text-rose-600 hover:text-rose-800 font-bold uppercase cursor-pointer transition">Нест кардан</button>
                        </form>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 italic">Ҳеҷ мақолае ёфт нашуд.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection