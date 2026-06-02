@extends('layouts.app')
@section('content')

<!-- ХУШОМАДЕД: СЛАЙДЕРИ БУЗУРГ ВА ОЛИҶАНОБ (PREMIUM CAROUSEL) -->
<div class="relative bg-emerald-950 text-white min-h-[550px] flex items-center justify-center overflow-hidden">
    <!-- Текстураи миллӣ дар замина -->
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#eab308_1px,transparent_1px)] [background-size:24px_24px] z-10 pointer-events-none"></div>
    
    <!-- СЛАЙДҲО (КАРУСЕЛЬ БО КАРТИНКАҲОИ НАМОЁН) -->
    <div id="carousel-container" class="absolute inset-0 w-full h-full z-0">
        <!-- Слайди 1 (Активӣ) -->
        <div class="carousel-slide absolute inset-0 w-full h-full opacity-100 transition-opacity duration-1000 ease-in-out">
            <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/40 via-emerald-950/60 to-emerald-950"></div>
        </div>
        
        <!-- Слайди 2 -->
        <div class="carousel-slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000 ease-in-out">
            <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/40 via-emerald-950/60 to-emerald-950"></div>
        </div>

        <!-- Слайди 3 -->
        <div class="carousel-slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000 ease-in-out">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/40 via-emerald-950/60 to-emerald-950"></div>
        </div>
    </div>

    <!-- МАТНИ СЛАЙДЕР (КОНТЕНТ) -->
    <div class="max-w-6xl mx-auto px-6 w-full text-center relative z-20 py-20 flex flex-col items-center pointer-events-none">
        
        
        <span class="text-[11px] text-amber-400 font-bold uppercase tracking-[0.3em] mb-4 block">Сомонаи Расмии Муассиса</span>
        
        <h2 class="serif-tj text-4xl md:text-6xl font-extrabold tracking-tight text-white uppercase leading-tight max-w-4xl">
            Муассисаи Таҳсилоти Миёнаи Умумии № 9
        </h2>
        
        <p class="serif-tj text-lg md:text-xl text-emerald-300 font-light italic mt-6 max-w-2xl tracking-wide">
            «Калиди тиллоии ояндаи дурахшон — дониши мукаммал аст»
        </p>
        
        <div class="w-32 h-[1px] bg-gradient-to-r from-transparent via-amber-400 to-transparent mt-8"></div>
        
        <p class="text-emerald-400/70 text-xs uppercase tracking-[0.2em] mt-4 font-medium">
            Вилояти Суғд • Ноҳияи Спитамен
        </p>
    </div>
    
    <!-- ТУГМАҲОИ ИДОРАКУНИИ КАРУСЕЛЬ -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-6 text-amber-400/50 text-xs tracking-widest font-bold z-30">
        <button id="prev-btn" class="hover:text-amber-400 cursor-pointer transition select-none">← ҚАБЛИ</button>
        <div class="flex gap-2">
            <div class="dot-indicator w-2 h-2 rounded-full bg-amber-400 transition-colors"></div>
            <div class="dot-indicator w-2 h-2 rounded-full bg-emerald-800 transition-colors"></div>
            <div class="dot-indicator w-2 h-2 rounded-full bg-emerald-800 transition-colors"></div>
        </div>
        <button id="next-btn" class="hover:text-amber-400 cursor-pointer transition select-none">БАЪДӢ →</button>
    </div>
</div>

<!-- БАХШИ АХБОР ВА РӮЙДОДҲО (ЧИСТАЯ МИНИМАЛИСТИЧНАЯ СЕТКА) -->
<div class="bg-[#faf8f5] py-24">
    <div class="max-w-6xl mx-auto px-6">
        
        <div class="text-center mb-16">
            <h3 class="serif-tj text-2xl md:text-3xl font-bold text-emerald-950 uppercase tracking-widest">Ахбор ва Рӯйдодҳо</h3>
            <p class="text-amber-600 text-[10px] font-bold uppercase tracking-[0.25em] mt-2">Навгониҳои охирини мактаби мо</p>
            <div class="w-12 h-[2px] bg-amber-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
            @forelse($posts as $post)
                <div class="group flex flex-col justify-between space-y-4">
                    <div class="space-y-4">
                        <div class="w-full h-64 bg-emerald-950/25 rounded-2xl overflow-hidden relative shadow-sm group-hover:shadow-xl transition-all duration-500">
                            @if($post->image) 
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"> 
                            @else 
                                <div class="w-full h-full flex items-center justify-center border border-emerald-900/10 rounded-2xl">
                                    <span class="serif-tj text-emerald-900/10 text-4xl font-black select-none tracking-widest">МТМУ 9</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-emerald-950/5 group-hover:bg-transparent transition-colors duration-500"></div>
                        </div>

                        <span class="text-[10px] text-amber-700 font-extrabold uppercase tracking-widest block pt-1">
                            {{ $post->created_at->format('d.m.Y — H:i') }}
                        </span>

                        <h4 class="serif-tj font-bold text-xl text-emerald-950 leading-snug group-hover:text-amber-600 transition-colors duration-300">
                            {{ $post->title }}
                        </h4>

                        <p class="text-gray-600 text-xs leading-relaxed font-light line-clamp-3">
                            {{ $post->content }}
                        </p>
                    </div>

                    <div class="pt-2 border-t border-amber-500/10">
                        <span class="text-[11px] font-bold text-emerald-950 uppercase tracking-wider group-hover:translate-x-1 inline-flex items-center gap-2 transition-transform duration-300 cursor-pointer">
                            Муфассал хондан <b class="text-amber-500 font-serif">→</b>
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 border border-dashed border-emerald-900/10 rounded-3xl">
                    <p class="text-gray-400 text-xs italic tracking-wide">Ҳанӯз ҳеҷ мақолае чоп нашудааст.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- ПАЁМИ РАҲБАРӢ -->
<div class="bg-white py-24 border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <span class="text-[10px] text-amber-600 font-black uppercase tracking-[0.3em] block mb-4">Муроҷиати Сарвар</span>
        <div class="serif-tj text-xl md:text-2xl text-emerald-950 font-light italic leading-relaxed px-4">
            «Мақсади асосии муассисаи мо — баланд бардоштани сатҳи дониши хонандагон, кашфи истеъдодҳои нав ва тарбияи насли наврас дар рӯҳияи ватандӯстиву хештаншиносӣ мебошад.»
        </div>
        <div class="w-8 h-[1px] bg-amber-500 mx-auto my-6"></div>
        <h5 class="text-xs font-bold text-emerald-950 uppercase tracking-widest">Расулов Абдуллоҷон</h5>
        <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Директори МТМУ №9</p>
    </div>
</div>

<!-- СКРИПТ БАРОИ КОР КАРДАНИ КАРУСЕЛЬ -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot-indicator');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        
        let currentIndex = 0;
        let slideInterval = setInterval(nextSlide, 5000);

        function updateSlider(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100');
                    dots[i].classList.remove('bg-emerald-800');
                    dots[i].classList.add('bg-amber-400');
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                    dots[i].classList.remove('bg-amber-400');
                    dots[i].classList.add('bg-emerald-800');
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlider(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateSlider(currentIndex);
        }

        nextBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            nextSlide();
            slideInterval = setInterval(nextSlide, 5000);
        });

        prevBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            prevSlide();
            slideInterval = setInterval(nextSlide, 5000);
        });
    });
</script>

@endsection