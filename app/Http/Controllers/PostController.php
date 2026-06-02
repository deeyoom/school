<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function index() {
        // Берем все статьи, начиная с последних
        $posts = Post::latest()->get();
        return view('home', compact('posts'));
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // 1. Проверяем, не админ ли это
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 2. Если не админ, проверяем, не учитель ли это
        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // Если никто не подошел — возвращаем ошибку
        return back()->withErrors(['login' => 'Логин ё пароли хато!']);
    }

    public function dashboard() {
        // Если зашел админ — отправляем в админку управления постами
        if (Auth::guard('admin')->check()) {
            $posts = Post::latest()->get();
            return view('admin', compact('posts'));
        }
        // Если зашел учитель — сразу перенаправляем в его журнал
        if (Auth::guard('teacher')->check()) {
            return redirect()->route('journal.index');
        }
        return redirect()->route('login');
    }

    public function store(Request $request) {
        if (!Auth::guard('admin')->check()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Загрузка картинки
        $path = $request->hasFile('image') ? $request->file('image')->store('posts', 'public') : null;

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path
        ]);

        return back()->with('success', 'Мақола чоп шуд!');
    }

    public function destroy($id) {
        if (!Auth::guard('admin')->check()) abort(403);
        Post::findOrFail($id)->delete();
        return back()->with('success', 'Мақола нест карда шуд!');
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}