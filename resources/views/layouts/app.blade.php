<!DOCTYPE html>
<html lang="tg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>МТМУ №9 — Сомонаи Расмӣ</title>
    <!-- Подключение Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- Настройка шрифтов для таджикской академической эстетики -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .serif-tj {
            font-family: 'Playfair Display', Georgia, serif;
        }
    </style>
</head>
<body class="bg-[#faf8f5] text-slate-900 min-h-screen flex flex-col justify-between">

    <!-- САРЛАВҲАИ СОМОНА (HEADER & NAVIGATION) -->
    <header class="bg-slate-950 border-b border-amber-500/20 shadow-sm sticky top-0 z-50 backdrop-blur-md bg-slate-950/95">
        <div class="max-w-6xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full border border-amber-400/40 flex items-center justify-center text-amber-400 font-serif text-sm font-bold bg-slate-900/50 shadow-inner group-hover:border-amber-400 transition-colors">
                    Ⅸ
                </div>
                <div>
                    <h1 class="serif-tj text-sm md:text-base font-black text-white uppercase tracking-wider leading-none">МТМУ №9</h1>
                    <span class="text-[9px] text-amber-400 font-bold uppercase tracking-[0.2em] block mt-1">Ноҳияи Спитамен</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="text-amber-400 transition-colors border-b border-amber-400 pb-1">Асосӣ</a>
                <a href="#" class="text-white/80 hover:text-amber-400 transition-colors pb-1">Омӯзгорон</a>
                <a href="#" class="text-white/80 hover:text-amber-400 transition-colors pb-1">Дастовардҳо</a>
                
                @if(Auth::guard('teacher')->check())
                    <a href="{{ route('journal.index') }}" class="bg-amber-500 text-slate-950 px-4 py-2 rounded-lg hover:bg-amber-400 transition-all shadow-md">Журнал</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-rose-400 hover:text-rose-300 transition-colors cursor-pointer">Баромад</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white/60 hover:text-white border border-white/20 px-4 py-2 rounded-lg transition-all">Вуруд</a>
                @endif
            </nav>

            <button class="md:hidden text-white hover:text-amber-400 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </header>

    <!-- АСОСИИ СОМОНА (ОСНОВНОЙ КОНТЕНТ) -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ПОЁНИ СОМОНА (FOOTER С ДИНАМИЧЕСКИМИ ДАТОЙ И ВРЕМЕНЕМ) -->
    <footer class="bg-emerald-950 text-white/50 text-[11px] border-t border-amber-500/15 py-5 mt-auto">
        <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-3">
            
            <div class="text-center sm:text-left flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                <span class="text-white/80 font-bold uppercase tracking-wide">© {{ date('Y') }} МТМУ №9</span>
                <span class="hidden sm:inline text-white/20">|</span>
                <span class="text-white/40 uppercase tracking-wider">Ҷумҳурии Тоҷикистон, Вилояти Суғд, Ноҳияи Спитамен</span>
            </div>

            <div class="flex items-center gap-2 text-amber-400/80 uppercase tracking-wider font-medium">
                <span id="current-date">--.--.----</span>
                <span class="text-white/20">•</span>
                <span id="current-time" class="font-mono font-bold text-white bg-emerald-900/40 px-2 py-0.5 rounded border border-emerald-850">00:00:00</span>
            </div>

        </div>
    </footer>

    <script>
        function updateLiveTime() {
            const now = new Date();
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('current-date').textContent = `${day}.${month}.${year}`;
            document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
        }
        updateLiveTime();
        setInterval(updateLiveTime, 1000);
    </script>

    <!-- СКРИПТ БАРОИ НАМОИШИ ВАҚТИ РЕАЛӢ (JS ДЛЯ ТОЧНОГО ВРЕМЕНИ) -->
    <script>
        function updateLiveTime() {
            const now = new Date();
            
            // Форматирование даты: ДД.ММ.ГГГГ
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = now.getFullYear();
            
            // Форматирование времени: ХХ:ММ:СС
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('current-date').textContent = `${day}.${month}.${year}`;
            document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Запуск функции сразу и обновление каждую секунду
        updateLiveTime();
        setInterval(updateLiveTime, 1000);
    </script>

</body>
</html>