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
            'numeroIdentificacion' => 'required|unique:estudiantes,numeroIdentificacion',
            'nombreCompleto' => 'required|string',
            'curso' => 'required|integer',
            'sexo' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        Estudiante::create([
            'numeroIdentificacion' => $request->numeroIdentificacion,
            'nombreCompleto' => $request->nombreCompleto,
            'curso' => $request->curso,
            'sexo' => $request->sexo,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return response()->json(['success' => 'Estudiante creado exitosamente.']);
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
        //
    }
}
