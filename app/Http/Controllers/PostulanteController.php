<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Estudiante;
use App\Models\Postulante;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validator = validator($request->all(), [
            'numeroIdentificacion_id' => 'required|string',
            'cargo_id' => 'required|string',
            'curso' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->redirectBackWithMessage(false, 'No se pudo registrar el postulante, por favor verifique los datos ingresados');
        }

        $postulante = Estudiante::where('numeroIdentificacion', $request->numeroIdentificacion_id)
            ->where('estado', '0')
            ->first();

        $postulante1 = Cargo::where('nombre_cargo', $request->cargo_id)->first();

        return $postulante;

        if ($postulante === null && $postulante1 === null) {
            return $this->redirectBackWithMessage(false, 'El número de identificación ingresado no concuerda con ningún estudiante registrado, o el estudiante no se encuentra activo');
        } else {
            Postulante::create($validator->validated());
            return $this->redirectBackWithMessage(true, 'Postulante registrado correctamente');
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
    public function show(Postulante $postulante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postulante $postulante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postulante $postulante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postulante $postulante)
    {
        //
    }
}
