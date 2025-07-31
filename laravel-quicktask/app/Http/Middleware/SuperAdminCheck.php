<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra user đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để truy cập tài nguyên này'
            ], 401);
        }

        $user = Auth::user();

        // Kiểm tra quyền SuperAdmin
        // Giả sử trong database có field 'role' hoặc 'is_super_admin'
        if (!$this->isSuperAdmin($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền truy cập tài nguyên này. Chỉ Super Admin mới được phép.'
            ], 403);
        }

        return $next($request);
    }

    private function isSuperAdmin($user): bool
    {
        return $user->hasRole("superadmin");
    }
}
