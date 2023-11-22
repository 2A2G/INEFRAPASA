<?php

namespace App\Http\Controllers;

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
        // Validate the request...
        $request->validate([
            'foto_postulante' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'numero_identidad_postulante' => 'required|string|max:255',
            'curso_postulante' => 'required|string|max:9',
            'cargo_postulante' => 'required|string|max:255',

        ]);

        $estudiante = Estudiante::where('numeroIdentificacion', $request->numero_identidad_postulante);

        if ($estudiante == true) {
        } else {
            return back()
                ->with('error', 'El estudiante con el número de identidad ' . $request->numero_identidad_postulante . ' no existe en la base de datos. Verifique e intente nuevamente.');
        }

        // Handle the uploaded image...
        if ($request->hasFile('foto_postulante')) {
            $imageName = time() . '.' . $request->foto_postulante->extension();
            $request->foto_postulante->move(public_path('candidatos'), $imageName);
        }

        // Store the postulante...
        $postulante = new Postulante;
        $postulante->name = $request->name;
        $postulante->degree = $request->degree;
        $postulante->foto_candidato = $imageName; // Save the path in the foto_candidato column
        $postulante->save();

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
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
