<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 5/4/23 .
 * Time: 8:32 PM .
 */

namespace App\Http\Middleware;

use Spatie\Permission\Exceptions\UnauthorizedException;
use Closure;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        return $next($request);
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if ($authGuard->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
