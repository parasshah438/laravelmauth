<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SingleSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  $guard
     */
    public function handle(Request $request, Closure $next, string $guard = null): Response
    {
        // Determine the guard to use
        $guard = $guard ?: 'web';
        
        // Only check for authenticated users
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            $currentSessionId = session()->getId();
            
            // Check if current session is valid
            if (!$this->isValidSession($user, $currentSessionId)) {
                $this->logInvalidSession($user, $currentSessionId, $request, $guard);
                
                // Logout and redirect to appropriate login page
                Auth::guard($guard)->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'You have been logged out due to login from another device.',
                        'redirect' => $this->getLoginRoute($guard)
                    ], 401);
                }
                
                return redirect()->route($this->getLoginRouteName($guard))
                    ->with('warning', 'You have been logged out because you logged in from another device.');
            }
        }
        
        return $next($request);
    }
    
    /**
     * Check if the current session is valid for the user.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @param  string  $currentSessionId
     * @return bool
     */
    protected function isValidSession($user, $currentSessionId): bool
    {
        // If user doesn't have an active session recorded, allow it
        if (!$user->active_session_id) {
            return true;
        }
        
        // Check if current session matches the stored active session
        return $user->active_session_id === $currentSessionId;
    }
    
    /**
     * Log invalid session attempt.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @param  string  $currentSessionId
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $guard
     * @return void
     */
    protected function logInvalidSession($user, $currentSessionId, $request, $guard): void
    {
        Log::warning('Invalid session detected - User logged out', [
            'guard' => $guard,
            'user_id' => $user->id,
            'email' => $user->email,
            'user_type' => get_class($user),
            'current_session' => $currentSessionId,
            'valid_session' => $user->active_session_id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'timestamp' => now(),
        ]);
    }
    
    /**
     * Get the login route for the guard.
     *
     * @param  string  $guard
     * @return string
     */
    protected function getLoginRoute($guard): string
    {
        return match ($guard) {
            'admin' => route('admin.login'),
            default => route('login'),
        };
    }
    
    /**
     * Get the login route name for the guard.
     *
     * @param  string  $guard
     * @return string
     */
    protected function getLoginRouteName($guard): string
    {
        return match ($guard) {
            'admin' => 'admin.login',
            default => 'login',
        };
    }
}
