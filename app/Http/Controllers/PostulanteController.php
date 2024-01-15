<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Curso;
use App\Models\Estado;
use App\Models\Estudiante;
use App\Models\Photo;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            // 'fotoPostulante' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        $postulante = Postulante::where('estudiante_id', $estudiante->estudiante_id)->first();
        if ($postulante) {
            return $this->redirectBackWithMessage(false, 'El estudiante ya se encuentra postulado a un cargo');
        }

        if ($cursoEstudiante->curso_id === $cursoIdUndecimo && $cargo->cargo_id === $cargoPersonero) {
            return $this->savePostulante($request);
        }
        if ($cursoEstudiante->curso_id === $cursoIdDecimo && $cargo->cargo_id === $cargoContralor) {
            return $this->savePostulante($request);
        }
        if ($cursoEstudiante->curso_id !== $cursoIdUndecimo && $cargo->cargo_id === $cargoRepresentante) {
            return $this->savePostulante($request);
        } else {
            return $this->savePostulante($request);
        }
    }

    public function savePostulante($request)
    {
        $estudianteId = Estudiante::where('numeroIdentificacion', $request->estudiante_id)->value('estudiante_id');
        $estadoActivoId = Estado::where('nombreEstado', 'Activo')->value('estado_id');

        DB::beginTransaction(); // Iniciar la transacción

        try {
            $savePostulante = new Postulante();
            $savePostulante = $savePostulante->create([
                'estudiante_id' => $estudianteId,
                'cargo_id' => $request->cargo_id,
                'estado_id' => $estadoActivoId,
            ]);

            if ($request->hasFile('imagenCandidato') && $request->file('imagenCandidato')->isValid()) {
                $path = $request->file('imagenCandidato')->store('/postulantes');
                $shortenedPath = Str::limit(md5($path), 40, '');

                $photo = new Photo();
                $photo = $photo->create([
                    'imagenCandidato' => $shortenedPath,
                    'postulante_id' => $savePostulante->postulante_id,
                    'estado_id' => $estadoActivoId,
                ]);
            }

            DB::commit(); // Confirmar la transacción si todo sale bien
            return $this->redirectBackWithMessage(true, 'Postulacion guardada exitosamente');
        } catch (\Throwable $th) {
            DB::rollBack(); // Revertir la transacción si hay un error
            return $this->redirectBackWithMessage(false, 'No se pudo registrar el postulante, por favor verifique los datos ingresados: ' . $th->getMessage());
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
