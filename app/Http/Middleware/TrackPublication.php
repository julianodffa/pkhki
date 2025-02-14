<?php

namespace App\Http\Middleware;

use App\Models\PublicationTraffic;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class TrackPublication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $slug = $request->route('publication')->slug ?? null; // Ambil slug dari URL (tile-slug)
        $title = $request->route('publication')->title ?? null; // Ambil slug dari URL (tile-slug)

        if ($slug) {
            $agent = new Agent();
            PublicationTraffic::create([
                'slug'       => $slug, // Simpan slug dari URL
                'title'      => $title, 
                'ip_address' => $request->ip(),
                'browser'    => $agent->browser(),
                'device'     => $agent->device() ?: 'Unknown', 
                'os'         => $agent->platform() ?: 'Unknown',
            ]);
        }

        return $next($request);
    }
}
