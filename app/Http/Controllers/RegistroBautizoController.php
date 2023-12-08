<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\RegistroBautizo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use function GuzzleHttp\Promise\all;
use App\Http\Resources\RegistroBautizoResource;

class RegistroBautizoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $registros = RegistroBautizo::all();

        return Inertia::render('Admin/Registros/Registro', [
            'registros' => RegistroBautizoResource::collection($registros)
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Registros/Crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'padre' => 'required',
            'madre' => 'required',
            'padrino' => 'required',
            'madrina' => 'required',
            'fecha_bautizo' => 'required|date',
            'lugar_bautizo' => 'required',
            'sacerdote' => 'required',
        ]);

        RegistroBautizo::create($request->all());

        return redirect()->route('registros.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $numero_registro)
    {
        // Obtén el registro basado en el número de registro proporcionado
        $registro = RegistroBautizo::where('numero_registro', $numero_registro)->first();

        // Verifica si el registro existe
        if (!$registro) {
            abort(404); // O maneja la situación de otra manera según tus necesidades
        }

        // Pasa los datos del registro a la vista
        return Inertia::render('Admin/Registros/Editar', [
            'registro' => [
                'numero_registro' => $registro->numero_registro,
                'nombre' => $registro->nombre,
                'padre' => $registro->padre,
                'madre' => $registro->madre,
                'padrino' => $registro->padrino,
                'madrina' => $registro->madrina,
                'fecha_bautizo' => $registro->fecha_bautizo,
                'lugar_bautizo' => $registro->lugar_bautizo,
                'sacerdote' => $registro->sacerdote,
                // Agrega más campos según sea necesario
            ],
        ]);
    }

    public function reporte(): Response
    {
        // Obtener todos los pagos
        $registros = RegistroBautizo::all();

        // Pasar los pagos a la vista
        return Inertia::render('Admin/Registros/Reporte', ['registros' => $registros]);
    }

    public function constancia($numero_registro)
    {
        $registro = RegistroBautizo::find($numero_registro);

        if ($registro) {
            return view('constancia', ['registros' => $registro]);
        } else {
            // Redirige a una página de error o muestra un mensaje indicando que el registro no se encontró
            return redirect()->back()->with('error', 'Registro no encontrado');
        }
    }


    public function buscarConstancia(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'numero_registro' => 'required',
            'apellido' => 'required',
        ]);

        $numeroRegistro = $request->input('numero_registro');
        $apellido = $request->input('apellido');

        // Realizar la búsqueda en la base de datos
        $registro = RegistroBautizo::where('numero_registro', $numeroRegistro)
            ->where(DB::raw("UPPER(nombre)"), 'LIKE', '%' . strtoupper($apellido) . '%')
            ->first();

        if ($registro) {
            // Devolver la información de la constancia
            return response()->json([
                'success' => true,
                'registro' => $registro,
            ]);
        } else {
            // Devolver un error si no se encuentra la constancia
            return response()->json([
                'success' => false,
                'message' => 'Constancia no encontrada',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->update($request->validated());
        return to_route('registros.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro = RegistroBautizo::findOrFail($id);
        $registro->delete();
        return to_route('registros.index');
    }
}
