<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Auth;

class CheckStudent
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('students')->check()==false){
            // dd(Auth::guard('students')->user()->name;);
            return redirect('login/user');
        }
        // $user = null;
        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        // } catch (\Exception $e) {
        //     if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        //         return $this -> returnError('E3001','INVALID_TOKEN');
        //     } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        //         return $this -> returnError('E3001','EXPIRED_TOKEN');
        //     } else {
        //         return $this -> returnError('E3001','TOKEN_NOTFOUND');
        //     }
        // } catch (\Throwable $e) {
        //     if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        //         return $this -> returnError('E3001','INVALID_TOKEN');
        //     } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        //         return $this -> returnError('E3001','EXPIRED_TOKEN');
        //     } else {
        //         return $this -> returnError('E3001','TOKEN_NOTFOUND');
        //     }
        // }

        // if (!$user)
        // $this -> returnError(trans('Unauthenticated'));
        return $next($request);
       
    }
}
