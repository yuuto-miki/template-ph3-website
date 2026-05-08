<?php
    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class IsAdmin
    {
        public function handle(Request $request, Closure $next): Response
        {
            // もしユーザーがログインしていない、または、管理フラグが 0 (false) ならば...
            if (!auth()->check() || !auth()->user()->is_admin) {
                // トップページ（/）へ強制リダイレクト（追い返す）！
                return redirect('/');
            }

            // 管理者なら、そのまま通してあげる
            return $next($request);
        }
    }