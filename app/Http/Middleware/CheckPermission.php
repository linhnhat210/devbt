<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        Log::info('CheckPermission middleware called', [
            'url' => $request->url(),
            'permission' => $permission ?? 'none',
        ]);

        // Nếu không có permission, cho phép tiếp tục mà không kiểm tra đăng nhập
        if ($permission === null) {
            return $next($request);
        }

        $user = Auth::user();

        // Kiểm tra đăng nhập chỉ khi có permission
        if (!$user) {
            abort(403, 'Bạn chưa đăng nhập');
        }

        // Kiểm tra quyền
        $userPermissions = $user->roles->flatMap(function ($role) {
            return $role->permissions->pluck('slug');
        })->unique();

        if ($userPermissions->contains($permission)) {
            return $next($request);
        }

        abort(403, 'Bạn không có quyền truy cập');
    }
}