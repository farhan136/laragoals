<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if($role != $user->is_admin){ // cek jika usernya memilki role user maka tidak boleh mengakses halaman admin
            // abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
            return redirect()->to(route('todo.index'));
        }else{
            return $next($request);
        }
 

    }
}
