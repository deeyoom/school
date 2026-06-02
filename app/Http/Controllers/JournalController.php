<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class JournalController extends Controller {
    public function index() {
        $teacherId = Auth::guard('teacher')->id();
        $class = SchoolClass::where('teacher_id', $teacherId)->first();
    
        // Если класса нет вообще — показываем пустую форму настройки
        if (!$class) return view('journal.index', ['class' => null, 'edit' => false]);
    
        $students = $class->students;
        $subjects = $class->subjects;
        
        // Собираем текущих учеников и предметы обратно в строчки для формы "Назад"
        $studentsText = $students->pluck('full_name')->implode("\n");
        $subjectsText = $subjects->pluck('name')->implode("\n");
    
        $currentQ = request('quarter', 'q1');
    
        $gradesMap = [];
        $rawGrades = Grade::whereIn('student_id', $students->pluck('id'))->get();
        foreach ($rawGrades as $g) {
            $gradesMap[$g->student_id][$g->subject_id] = $g;
        }
    
        // Если в ссылке есть ?mode=edit, принудительно откроем форму редактирования
        $editMode = request('mode') === 'edit';
    
        return view('journal.index', compact(
            'class', 'students', 'subjects', 'gradesMap', 'currentQ', 
            'studentsText', 'subjectsText', 'editMode'
        ));
    }

    public function setupClass(Request $request) {
        $request->validate(['class_name' => 'required', 'students' => 'required', 'subjects' => 'required']);
    
        // Ищем существующий класс учителя или создаем новый
        $class = SchoolClass::updateOrCreate(
            ['teacher_id' => Auth::guard('teacher')->id()],
            ['name' => $request->class_name]
        );
    
        // Получаем массивы строк от пользователя
        $newStudents = array_filter(array_map('trim', explode("\n", $request->students)));
        $newSubjects = array_filter(array_map('trim', explode("\n", $request->subjects)));
    
        // Синхронизируем учеников: удаляем тех, кого стерли, добавляем новых
        $currentStudentIds = [];
        foreach ($newStudents as $name) {
            $student = Student::updateOrCreate(['full_name' => $name, 'school_class_id' => $class->id]);
            $currentStudentIds[] = $student->id;
        }
        Student::where('school_class_id', $class->id)->whereNotIn('id', $currentStudentIds)->delete();
    
        // Синхронизируем предметы
        $currentSubjectIds = [];
        foreach ($newSubjects as $name) {
            $subject = Subject::updateOrCreate(['name' => $name, 'school_class_id' => $class->id]);
            $currentSubjectIds[] = $subject->id;
        }
        Subject::where('school_class_id', $class->id)->whereNotIn('id', $currentSubjectIds)->delete();
    
        return redirect()->route('journal.index');
    }

    public function saveGrades(Request $request) {
        // Изменяем max:5 на max:10 и min:2 на min:1
        $request->validate([
            'grades' => 'required|array',
            'grades.*.*' => 'nullable|integer|min:1|max:10', 
            'quarter' => 'required|string'
        ]);
    
        $quarter = $request->quarter;
    
        foreach ($request->grades as $studentId => $subjects) {
            foreach ($subjects as $subjectId => $value) {
                // Сохраняем или обновляем оценку в базе данных
                if ($value !== null) {
                    Grade::updateOrCreate(
                        ['student_id' => $studentId, 'subject_id' => $subjectId],
                        [$quarter => $value]
                    );
                } else {
                    // Если учитель стёр оценку — очищаем её в БД для этой четверти
                    $grade = Grade::where('student_id', $studentId)->where('subject_id', $subjectId)->first();
                    if ($grade) {
                        $grade->update([$quarter => null]);
                    }
                }
            }
        }
    
        return redirect()->back()->with('success', 'Баҳоҳо бомуваффақият сабт шуданд!');
    }
    public function exportPdf(Request $request) {
        $teacherId = Auth::guard('teacher')->id();
        $class = SchoolClass::where('teacher_id', $teacherId)->first();
        
        if (!$class) return back();
    
        $students = $class->students;
        $subjects = $class->subjects;
        $currentQ = $request->query('quarter', 'q1');
    
        $gradesMap = [];
        $rawGrades = Grade::whereIn('student_id', $students->pluck('id'))->get();
        foreach ($rawGrades as $g) {
            $gradesMap[$g->student_id][$g->subject_id] = $g;
        }
    
        // Тарҷумаи номи чоракҳо барои сарлавҳаи PDF
        $quartersTj = ['q1' => 'Чораки 1', 'q2' => 'Чораки 2', 'q3' => 'Чораки 3', 'q4' => 'Чораки 4'];
        $quarterName = $quartersTj[$currentQ] ?? 'Чораки 1';
    
        // Боркунии шаблон ва табдил ба PDF
        $pdf = Pdf::loadView('journal.pdf', compact('class', 'students', 'subjects', 'gradesMap', 'currentQ', 'quarterName'));
        
        // Скачат кардани файл бо номи синф ва чорак
        return $pdf->download("Журнал_Синфи_{$class->name}_{$quarterName}.pdf");
    }
}