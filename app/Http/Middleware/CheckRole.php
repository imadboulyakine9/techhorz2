<?php
// app/Http/Middleware/CheckRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
     public function handle(Request $request, Closure $next, $role)
    {
       /* if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);*/

        if (!Auth::check()) {
            return redirect('login');
        }
    
        if (empty($roles)) {
            return $next($request);
        }
    
        foreach ($roles as $role) {
            if (Auth::user()->role === $role) {
                return $next($request);
            }
        }
    
        abort(403, 'Unauthorized action.');
    } 

    
}