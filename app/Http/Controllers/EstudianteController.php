<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SVE.rolEstudiante.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SVE.rolEstudiante.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'numeroIdentificacion' => 'required|string|unique:estudiantes,numeroIdentificacion',
            'nombreCompleto' => 'required|string|alpha_spaces',
            'curso' => 'required|string',
            'sexo' => 'required|string|alpha_spaces',
        ]);

        if ($validator->fails()) {
            // Redirige a la vista deseada con los datos de la sesión
            return back()
                ->with('status', false)
                ->with('message', 'No se pudo registrar el estudiante, por favor verifique los datos ingresados');
        }

        $estudiante = new Estudiante();
        $estudiante->create($validator->validated());

        // Redirige a la vista deseada con los datos de la sesión
        return back()
            ->with('status', true)
            ->with('message', 'Estudiante registrado correctamente');
    }




    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        // $validator = validator(request()->all(), [
        //     'estudiante' => 'required|exists:estudiantes,id',
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
    }
}
