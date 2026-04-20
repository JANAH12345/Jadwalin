<?php

namespace App\Http\Middleware;

use App\Models\Jadwal;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncJadwalStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan sinkronisasi status jadwal
        Jadwal::syncStatuses();

        return $next($request);
    }
}
