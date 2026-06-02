@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto my-20 px-4">
    <div class="bg-white border border-gray-100 p-8 rounded-2xl shadow-xl border-t-4 border-amber-500">
        <h2 class="serif-tj text-2xl font-bold text-cyan-950 mb-6 text-center uppercase tracking-wide">Вуруд ба система</h2>
        
        @if($errors->any()) 
            <div class="mb-4 p-3 bg-rose-50 text-rose-700 font-bold text-xs rounded-lg border border-rose-200">
                {{ $errors->first() }}
            </div> 
        @endif
        
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">Логин:</label>
                <input type="text" name="login" required class="w-full border border-gray-200 p-3 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-sm transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">Парол:</label>
                <input type="password" name="password" required class="w-full border border-gray-200 p-3 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-sm transition">
            </div>
            <button type="submit" class="w-full bg-cyan-950 hover:bg-cyan-900 text-amber-400 font-bold py-3.5 rounded-xl uppercase text-xs tracking-widest shadow-md transition cursor-pointer">Ворид шудан</button>
        </form>
    </div>
</div>
@endsection