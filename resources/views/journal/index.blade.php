@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    
    <!-- ТАНЗИМОТИ СИНФ (ФОРМА НАСТРОЙКИ НА ТАДЖИКСКОМ) -->
    @if(!$class || isset($editMode) && $editMode)
        <div class="max-w-xl mx-auto bg-white border border-gray-100 p-8 rounded-2xl shadow-xl border-t-4 border-amber-500">
            <div class="flex justify-between items-center mb-2">
                <h2 class="serif-tj text-xl font-bold text-cyan-950 uppercase tracking-wide">⚙ Танзимоти рӯйхати синф</h2>
                @if($class)
                    <a href="{{ route('journal.index') }}" class="text-xs font-bold text-rose-600 hover:underline">← Ба қафо</a>
                @endif
            </div>
            <p class="text-xs text-gray-500 mb-6">Шумо метавонед номҳо ва фанҳои навро ба сатри нав илова кунед.</p>
            
            <form action="{{ route('journal.setup') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Номи синф:</label>
                    <input type="text" name="class_name" value="{{ $class->name ?? '' }}" required placeholder="Масалан: 11 'А'" class="w-full border border-gray-200 p-3 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Рӯйхати хонандагон (Ҳар як хонанда дар сатри нав):</label>
                    <textarea name="students" rows="6" required class="w-full border border-gray-200 p-3 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-xs transition font-mono">{{ $studentsText ?? '' }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Рӯйхати фанҳо (Ҳар як фан дар сатри нав):</label>
                    <textarea name="subjects" rows="5" required class="w-full border border-gray-200 p-3 rounded-xl bg-gray-50/50 focus:bg-white focus:border-cyan-950 focus:outline-none text-xs transition font-mono">{{ $subjectsText ?? '' }}</textarea>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="w-full bg-cyan-950 hover:bg-cyan-900 text-amber-400 font-bold py-3.5 rounded-xl text-xs uppercase tracking-widest transition cursor-pointer shadow-md">Сабт ва Навсозӣ</button>
                </div>
            </form>
        </div>
    @else
        <!-- ЖУРНАЛИ ЭЛЕКТРОНӢ (ВЕБ-ЖУРНАЛ С ИСПРАВЛЕННОЙ СЕТКОЙ) -->
        <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">
            
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center border-b border-gray-100 pb-6 mb-6 gap-6">
                <div>
                    <h2 class="serif-tj text-2xl font-bold text-cyan-950 uppercase">Журнали синфи {{ $class->name }}</h2>
                    <p class="text-[11px] text-amber-600 font-bold uppercase tracking-wider mt-0.5">Муассисаи таҳсилоти миёнаи умумии №9</p>
                    
                    <div class="flex gap-3 mt-3">
                        <a href="{{ route('journal.index', ['mode' => 'edit']) }}" class="text-[11px] bg-slate-100 hover:bg-slate-200 text-cyan-950 font-bold px-3 py-1.5 rounded-lg border border-slate-200 transition">
                            + Иловаи хонандагон
                        </a>
                        <a href="{{ route('journal.index', ['mode' => 'edit']) }}" class="text-[11px] bg-slate-100 hover:bg-slate-200 text-cyan-950 font-bold px-3 py-1.5 rounded-lg border border-slate-200 transition">
                            + Иловаи фанҳо
                        </a>
                        <div class="mt-4 flex flex-wrap gap-3">
    @php
        // Проверяем в карте оценок, есть ли хотя бы одна оценка для каждой четверти
        $hasQ1 = false;
        $hasQ2 = false;
        $hasQ3 = false;
        $hasQ4 = false;

        foreach($gradesMap as $studentGrades) {
            foreach($studentGrades as $grade) {
                if (!empty($grade->q1)) $hasQ1 = true;
                if (!empty($grade->q2)) $hasQ2 = true;
                if (!empty($grade->q3)) $hasQ3 = true;
                if (!empty($grade->q4)) $hasQ4 = true;
            }
        }
    @endphp

    {{-- Кнопка для 1-й четверти --}}
    @if($hasQ1)
        <a href="{{ route('journal.pdf', ['quarter' => 'q1']) }}" class="inline-flex items-center gap-2 text-xs bg-emerald-700 hover:bg-emerald-800 text-white font-black uppercase tracking-wider px-4 py-2.5 rounded-xl shadow-sm transition">
            📥 Боргирии PDF (Чораки 1)
        </a>
    @endif

    {{-- Кнопка для 2-й четверти --}}
    @if($hasQ2)
        <a href="{{ route('journal.pdf', ['quarter' => 'q2']) }}" class="inline-flex items-center gap-2 text-xs bg-emerald-700 hover:bg-emerald-800 text-white font-black uppercase tracking-wider px-4 py-2.5 rounded-xl shadow-sm transition">
            📥 Боргирии PDF (Чораки 2)
        </a>
    @endif

    {{-- Кнопка для 3-й четверти --}}
    @if($hasQ3)
        <a href="{{ route('journal.pdf', ['quarter' => 'q3']) }}" class="inline-flex items-center gap-2 text-xs bg-emerald-700 hover:bg-emerald-800 text-white font-black uppercase tracking-wider px-4 py-2.5 rounded-xl shadow-sm transition">
            📥 Боргирии PDF (Чораки 3)
        </a>
    @endif

    {{-- Кнопка для 4-й четверти --}}
    @if($hasQ4)
        <a href="{{ route('journal.pdf', ['quarter' => 'q4']) }}" class="inline-flex items-center gap-2 text-xs bg-emerald-700 hover:bg-emerald-800 text-white font-black uppercase tracking-wider px-4 py-2.5 rounded-xl shadow-sm transition">
            📥 Боргирии PDF (Чораки 4)
        </a>
    @endif
</div>
                    </div>
                </div>
                
                <!-- Интихоби чоракҳо (Переключатель четвертей строго на таджикском) -->
                <div class="flex bg-gray-100 p-1 rounded-xl border border-gray-200 text-xs font-bold shadow-inner self-center lg:self-auto">
                    @foreach(['q1'=>'Чораки 1', 'q2'=>'Чораки 2', 'q3'=>'Чораки 3', 'q4'=>'Чораки 4'] as $key => $label)
                        <a href="{{ route('journal.index', ['quarter' => $key]) }}" class="px-5 py-2.5 rounded-lg transition {{ $currentQ == $key ? 'bg-cyan-950 text-amber-400 shadow' : 'text-gray-600 hover:text-cyan-950' }}">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            @if(session('success')) 
                <div class="mb-4 p-3 bg-emerald-800 text-white text-xs font-bold rounded-xl shadow">
                    {{ session('success') }}
                </div> 
            @endif

            @php
                $subjectTotals = [];
                $subjectCounts = [];
            @endphp

            <form action="{{ route('journal.grades.save') }}" method="POST" class="overflow-x-auto select-none pb-4">
                @csrf 
                <input type="hidden" name="quarter" value="{{ $currentQ }}">
                
                <table class="min-w-max mx-auto border-collapse border-2 border-cyan-950 text-xs shadow-md">
                    <thead class="bg-cyan-950 text-white">
                        <tr>
                            <!-- Насаб ва Номи хонанда -->
                            <th class="p-4 border-2 border-cyan-950 text-left text-sm font-bold min-w-[280px] bg-cyan-950 align-middle">
                                Насаб ва Номи хонанда
                            </th>
                            
                            <!-- Навсозии фанҳо: Текст меистад рост дар маркази клетка -->
                            @foreach($subjects as $subject)
                                <th class="border-2 border-cyan-950 p-2 w-16 h-48 bg-cyan-950 text-center align-middle">
                                    <span class="inline-block uppercase tracking-wider font-black text-[11px] text-amber-400 text-center" 
                                          style="writing-mode: vertical-lr; transform: rotate(180deg); margin: 0 auto;">
                                        {{ $subject->name }}
                                    </span>
                                </th>
                                @php
                                    $subjectTotals[$subject->id] = 0;
                                    $subjectCounts[$subject->id] = 0;
                                @endphp
                            @endforeach

                            <!-- Сатҳи азхудкунии хонанда (Успеваемость ученика) -->
                            <th class="border-2 border-cyan-950 p-3 w-28 text-center text-[10px] font-black uppercase text-amber-400 bg-cyan-900/60 align-middle leading-tight">
                                Сатҳи азхудкунии<br>хонанда
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-cyan-950">
                        @foreach($students as $student)
                            @php
                                $studentSum = 0;
                                $studentCount = 0;
                            @endphp
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 border-2 border-cyan-950 font-bold text-left text-cyan-950 text-sm bg-gray-100/70">
                                    {{ $student->full_name }}
                                </td>

                                @foreach($subjects as $subject)
                                    @php 
                                        $gradeObj = $gradesMap[$student->id][$subject->id] ?? null; 
                                        $currentGrade = $gradeObj?->$currentQ;
                                        
                                        if($currentGrade) {
                                            $studentSum += $currentGrade;
                                            $studentCount++;
                                            $subjectTotals[$subject->id] += $currentGrade;
                                            $subjectCounts[$subject->id]++;
                                        }
                                    @endphp
                                    <td class="p-1 border-2 border-cyan-950 text-center bg-white w-16 h-12">
                                    <input type="number" 
                                    name="grades[{{ $student->id }}][{{ $subject->id }}]" 
                                    value="{{ $currentGrade }}" 
                                    min="1" max="10" placeholder="-" 
                                    class="w-full h-10 text-center font-black text-cyan-950 focus:outline-none focus:bg-amber-50/50 rounded-lg text-base border border-transparent focus:border-amber-400 transition">
                                    </td>
                                @endforeach

                                <td class="p-4 border-2 border-cyan-950 text-center font-black text-sm text-cyan-950 bg-amber-50/20">
                                    {{ $studentCount > 0 ? number_format($studentSum / $studentCount, 1) : '-' }}
                                </td>
                            </tr>
                        @endforeach

                        <!-- Сатҳи азхудкунии синф (Успеваемость класса) -->
                        <tr class="bg-cyan-950/5">
                            <td class="p-4 border-2 border-cyan-950 font-black text-left uppercase text-xs text-cyan-950 bg-gray-100">
                                Сатҳи азхудкунии синф
                            </td>
                            @foreach($subjects as $subject)
                                <td class="p-4 border-2 border-cyan-950 text-center font-black text-sm text-emerald-800 bg-emerald-50/30">
                                    {{ $subjectCounts[$subject->id] > 0 ? number_format($subjectTotals[$subject->id] / $subjectCounts[$subject->id], 1) : '-' }}
                                </td>
                            @endforeach
                            <td class="border-2 border-cyan-950 bg-cyan-950/10"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-cyan-950 hover:bg-cyan-900 text-amber-400 font-bold text-xs uppercase tracking-widest px-10 py-4 rounded-xl shadow-md cursor-pointer transition">Сабти баҳоҳо</button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection