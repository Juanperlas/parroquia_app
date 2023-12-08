<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\Comentario;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\RegistroBautizo;
use App\Http\Resources\UserSharedResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
{
    return array_merge(parent::share($request), [
        'auth.user' => fn () => $request->user()
            ? new UserSharedResource($request->user())
            : null,
        'ziggy' => function () use ($request) {
            return array_merge((new Ziggy)->toArray(), [
                'location' => $request->url(),
            ]);
        },
        'comentarios.hoy' => fn () => $request->user()
            ? Comentario::whereDate('created_at', Carbon::today())->get()
            : null,
        'bautizos' => function () {
            // Obtener el número de registros de bautizo realizados hoy
            $bautizosHoy = RegistroBautizo::whereDate('created_at', Carbon::today())->count();

            // Obtener el total de registros de bautizo
            $totalBautizos = RegistroBautizo::count();

            return [
                'hoy' => $bautizosHoy,
                'total' => $totalBautizos,
            ];
        },
    ]);
}
}
