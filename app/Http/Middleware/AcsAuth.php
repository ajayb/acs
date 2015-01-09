<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;

class AcsAuth implements Middleware {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if ($this->auth->check() && app('session')->get('assignedRoles') == null)
        {            
            $assignedRoles = array();
            
            $userRole = \Auth::user()->getRole();

            switch ($userRole)
            {
                case 'admin':
                    $assignedRoles[] = 'admin';                      
                case 'manager':
                    $assignedRoles[] = 'manager';
                case 'operator':
                    $assignedRoles[] = 'operator';                    
                    break;
                default:
                    throw new \Exception("The employee status entered does not exist");
            }
            app('session')->put('userRole', $userRole);
            app('session')->put('assignedRoles', $assignedRoles);
        }
        else if($this->auth->guest())
        {
            return redirect()->guest('user/login');
        }

        return $next($request);
    }

}
