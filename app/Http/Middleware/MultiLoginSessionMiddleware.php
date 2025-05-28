<?php
// 1. Buat middleware baru untuk mengelola sesi multi-login
// app/Http/Middleware/MultiLoginSessionMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MultiLoginSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {   
        // Ambil user_id dari URL jika ada (misalnya: /user/123/dashboard)
        $userId = $request->route('user_id');
        
        if ($userId) {
            // Set cookie path berdasarkan user_id
            Config::set('session.path', '/user/' . $userId);
        }
        
        return $next($request);
    }
}