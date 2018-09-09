<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Dashboard\TanggalBerangkatController as StatusUser;
class DokumenStep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $akses = StatusUser::akses();
        if ($akses['data']) {
            return $next($request);
        } else {
            return redirect('splash_upload_dokumen');
        }
    }
}
