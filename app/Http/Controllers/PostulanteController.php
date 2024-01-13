<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Curso;
use App\Models\Estado;
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
        // Validación inicial
        $validator = validator($request->all(), [
            'estudiante_id' => 'required|string',
            'cargo_id' => 'required|string',
            'fotoPostulante' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->redirectBackWithMessage(false, 'No se pudo registrar el postulante, por favor verifique los datos ingresados');
        }

        // Obtener estudiante, cargo y estado activo
        $estudiante = Estudiante::where('numeroIdentificacion', $request->estudiante_id)->with('curso', 'estado')->paginate(20)->first();
        $cargo = Cargo::where('cargo_id', $request->cargo_id)->first();
        $cursoEstudiante = Curso::where('curso_id', $estudiante->curso_id)->first();

        // Verificar si el estudiante y el cargo existen
        if (!$estudiante || !$cargo) {
            return $this->redirectBackWithMessage(false, 'El número de identificación ingresado no concuerda con ningún estudiante registrado, o no existe el cargo ingresado');
        }

        // Verificar si el estudiante y el cargo están activos
        $estadoActivoId = Estado::where('nombreEstado', 'Activo')->value('estado_id');
        if ($estudiante->estado_id !== $estadoActivoId || $cargo->estado_id !== $estadoActivoId) {
            return $this->redirectBackWithMessage(false, 'El estudiante ingresado no se encuentra disponible o el cargo no se encuentra disponible');
        }

        // Validación de cargos por curso
        $cursoIdUndecimo = Curso::where('nombreCurso', 'Undecimo')->value('curso_id');
        $cursoIdDecimo = Curso::where('nombreCurso', 'Decimo')->value('curso_id');

        //Validación de cargos
        $cargoPersonero = Cargo::where('nombreCargo', 'Personero')->value('cargo_id');
        $cargoContralor = Cargo::where('nombreCargo', 'Contralor')->value('cargo_id');
        $cargoRepresentante = Cargo::where('nombreCargo', 'Representante de Curso')->value('cargo_id');

        // Validación de postulación
        $posulante = Postulante::where('estudiante_id', $estudiante->estudiante_id)->first();
        if ($posulante) {
            return $this->redirectBackWithMessage(false, 'El estudiante ya se encuentra postulado a un cargo');
        }

        // Guardar la imagen y obtener la ruta
        if ($request->hasFile('fotoPostulante')) {
            $imageName = time() . '.' . $request->fotoPostulante->extension();
            $path = $request->fotoPostulante->storeAs('images', $imageName);
        } else {
            return $this->redirectBackWithMessage(false, 'No se ha proporcionado ninguna imagen.');
        }

        if ($cursoEstudiante->curso_id === $cursoIdUndecimo && $cargo->cargo_id === $cargoPersonero) {
            // Crear postulante
            // Crear postulante con la ruta de la imagen
            $savePostulante = new Postulante();
            $savePostulante = $savePostulante->create([
                'estudiante_id' => $request->estudiante_id,
                'cargo_id' => $request->cargo_id,
                'estado_id' => $request->estado_id, // Asegúrate de que esta información se envía en la solicitud
                'fotoPostulante' => $path,
            ]);
            $savePostulante->save();
            return $this->redirectBackWithMessage(true, 'Postulacion a personero exitosa');
        }
        if ($cursoEstudiante->curso_id === $cursoIdDecimo && $cargo->cargo_id === $cargoContralor) {
            // Crear postulante
            // Crear postulante con la ruta de la imagen
            $savePostulante = new Postulante();
            $savePostulante = $savePostulante->create([
                'estudiante_id' => $request->estudiante_id,
                'cargo_id' => $request->cargo_id,
                'estado_id' => $request->estado_id, // Asegúrate de que esta información se envía en la solicitud
                'fotoPostulante' => $path,
            ]);
            $savePostulante->save();

            return $this->redirectBackWithMessage(true, 'Postulacion a contralor exitosa');
        }
        if ($cursoEstudiante->curso_id !== $cursoIdUndecimo && $cargo->cargo_id === $cargoRepresentante) {
            // Crear postulante
            // Crear postulante con la ruta de la imagen
            $savePostulante = new Postulante();
            $savePostulante = $savePostulante->create([
                'estudiante_id' => $request->estudiante_id,
                'cargo_id' => $request->cargo_id,
                'estado_id' => $request->estado_id, // Asegúrate de que esta información se envía en la solicitud
                'fotoPostulante' => $path,
            ]);
            $savePostulante->save();

            return $this->redirectBackWithMessage(true, 'Postulacion a representante de curso exitosa');
        } else {
            return $this->redirectBackWithMessage(false, 'El estudiante no puede postularse a este cargo');
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
