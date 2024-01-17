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
    public function store($component, Request $request)
    {
        // return $request;
        $validator = validator($request->all(), [
            'numeroIdentificacion' => 'required|string',
            'nombreCompleto' => 'required|string',
            'curso_id' => 'required|integer',
            'sexo' => 'required|string',
            'estado_id' => 'required|integer',
            
        ]);

        if ($validator->fails()) {
            return $this->redirectBackWithMessage(false, $validator->errors()->first());
        }

        $estudiante = Estudiante::where('numeroIdentificacion', $request->numeroIdentificacion)->first();
        // return $estudiante;

        if ($estudiante === null) {
            Estudiante::create($validator->validated());
            return $this->redirectBackWithMessage(true, 'Estudiante registrado correctamente');
        } else {
            $estudiante->update($validator->validated());
            return $this->redirectBackWithMessage(true, 'Estudiante actualizado correctamente');
        }
    }

    private function redirectBackWithMessage($status, $message)
    {
        return back()
            ->with('status', $status)
            ->with('message', $message);
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
    public function update($component, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($component, Estudiante $estudiante)
    {
        // return $estudiante;
        if ($estudiante == null) {
            return back()
                ->with('status', false)
                ->with('message', 'No se pudo eliminar el estudiante, por favor verifique los datos ingresados');
        }
        $estudiante->estado = '1';
        $estudiante->save();
        return back()
            ->with('status', true)
            ->with('message', 'Estudiante eliminado correctamente');
    }
}
