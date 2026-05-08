<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // これが重要です
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ▼ ▼ ▼ 今回追加したログイン後の振り分け処理 ▼ ▼ ▼
        
        // もしログインしたユーザーが「管理者（is_admin が 1）」だったら
        if (Auth::user()->is_admin) {
            // 管理者専用ダッシュボードへリダイレクト
            return redirect()->route('admin.dashboard'); 
        }

        // 一般ユーザー（is_admin が 0）だったら、通常のダッシュボードへ
        return redirect()->intended(RouteServiceProvider::HOME);
        
        // ▲ ▲ ▲ ここまで ▲ ▲ ▲
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}