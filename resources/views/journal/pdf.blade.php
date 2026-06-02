<!DOCTYPE html>
<html lang="tg">
<head>
    <meta charset="UTF-8">
    <title>Ҷадвали баҳоҳо</title>
    <style>
        /* Барои нишон додани ҳуруфи тоҷикӣ ва кирилликӣ бе хатогиҳо */
        body { font-family: 'Dejavu Sans', sans-serif; font-size: 11px; color: #0f172a; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 16px; font-weight: bold; color: #111827; uppercase; }
        .subtitle { font-size: 11px; color: #b45309; margin-top: 5px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { bg-color: #0f172a; background: #0f172a; color: #ffffff; font-size: 10px; }
        .student-name { text-align: left; font-weight: bold; width: 200px; }
        .total-row { font-weight: bold; background-color: #f1f5f9; }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">МУАССИСАИ ТАҲСИЛОТИ МИЁНАИ УМУМИИ №9</div>
        <div class="subtitle">Ҷадвали холҳои синфи {{ $class->name }} — {{ $quarterName }}</div>
    </div>

    @php
        $subjectTotals = [];
        $subjectCounts = [];
    @endphp

    <table>
        <thead>
            <tr>
                <th style="text-align: left;">Насаб ва Номи хонанда</th>
                @foreach($subjects as $subject)
                    <th>{{ $subject->name }}</th>
                    @php
                        $subjectTotals[$subject->id] = 0;
                        $subjectCounts[$subject->id] = 0;
                    @endphp
                @endforeach
                <th>Сатҳи азхудкунӣ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                @php $studentSum = 0; $studentCount = 0; @endphp
                <tr>
                    <td class="student-name">{{ $student->full_name }}</td>
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
                        <td>{{ $currentGrade ?? '-' }}</td>
                    @endforeach
                    <td style="font-weight: bold;">
                        {{ $studentCount > 0 ? number_format($studentSum / $studentCount, 1) : '-' }}
                    </td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td style="text-align: left;">Сатҳи азхудкунии синф</td>
                @foreach($subjects as $subject)
                    <td>
                        {{ $subjectCounts[$subject->id] > 0 ? number_format($subjectTotals[$subject->id] / $subjectCounts[$subject->id], 1) : '-' }}
                    </td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>

</body>
</html>