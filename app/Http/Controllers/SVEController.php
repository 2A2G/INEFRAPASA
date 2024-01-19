<?php

namespace App\Http\Controllers;

use App\Models\SVE;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\conteoVoto;
use App\Models\Curso;
use App\Models\Estado;
use App\Models\Estudiante;
use App\Models\Photo;
use App\Models\Postulante;
use App\Models\votacion;
use App\Models\Voto;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class SVEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SistemaVotacion.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = validator($request->all(), [
            'numeroIdentidad' => 'required|string|max:10|min:10',
        ]);

        // return $request;
        $estadoActivoId = Estado::where('nombreEstado', 'Activo')->value('estado_id');
        $estudiante = Estudiante::where('numeroIdentificacion', $request->numeroIdentidad)->where('estado_id', $estadoActivoId)->first();

        // return $estudiante;

        // Verificar si el estudiante existe
        if (!$estudiante) {
            session()->flash('message', 'El estudiante con el número de identidad ' . $request->numeroIdentidad . ', no existe en la base de datos. Verifique e intente nuevamente.');
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $cantidadCargos = Cargo::where('estado_id', $estadoActivoId)->count();
        $estudianteVoto = Voto::where('estudiante_id', $estudiante->estudiante_id)->get();

        if ($estudianteVoto->isEmpty()) {
            // Si el estudiante no ha votado, mostrar todas las postulaciones
            $postulaciones = Postulante::paginate($cantidadCargos);
            session()->flash('status', 'success');
            return view('SistemaVotacion.index', ['estudiante' => $estudiante, 'postulaciones' => $postulaciones, 'cargos' => Cargo::all(), 'estudiante' => $estudiante]);
        }
        $cargoRepresentanteCurso = Cargo::where('nombreCargo', 'Representante de Curso')->value('cargo_id');
        $cargoControladores = Cargo::where('nombreCargo', 'Controladores')->value('cargo_id');
        $cargoPersonero = Cargo::where('nombreCargo', 'Personero')->value('cargo_id');

        // Si el estudiante ya ha votado
        foreach ($estudianteVoto as $voto) {
            if ($voto->cargo_id == $cargoRepresentanteCurso) {
                // Mostrar la página de los controladores
                $postulaciones = Postulante::where('cargo_id', $cargoControladores)->paginate($cantidadCargos);
            } elseif ($voto->cargo_id == $cargoControladores) {
                // Mostrar la página del personero
                $postulaciones = Postulante::where('cargo_id', $cargoPersonero)->paginate($cantidadCargos);
            } else {
                session()->flash('message', 'El estudiante con el número de identidad ' . $request->numeroIdentidad . ', ya ha votado.');
                session()->flash('status', 'error');
                return redirect()->back();
            }
            return view('SistemaVotacion.index', compact('postulaciones'));
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //AQUI VAN LAS VOTACIONES  
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $component = $request->route('component', 'dashboard');
        $totalHombres = Estudiante::where('sexo', 'Masculino')->count();
        $totalMujeres = Estudiante::where('sexo', 'Femenino')->count();
        $totalEstudiantes = Estudiante::all()->count();
        $estadoPendiente = Estado::where('nombreEstado', 'Pendiente')->value('estado_id');
        $curso = Curso::all();
        $cargo = Cargo::all();
        $estado = Estado::all();


        // return $cargo;

        switch ($component) {
            case 'estudiante':
                $data = Estudiante::with('curso', 'estado',)->paginate(20);
                // return $data;
                break;
            case 'postulaciones':
                $data = Postulante::with('cargo', 'estudiante.curso', 'photo')
                    ->where('estado_id', $estadoPendiente)
                    ->paginate(10);
                break;
            case 'conteovotos':
                $data = conteoVoto::all();
                break;
                // Agrega más casos según sea necesario...
            default:
                $data = [];
                break; // Datos por defecto
        }

        return view('dashboard', [
            'component' => $component, 'data' => $data, 'curso' => $curso,
            'cargo' => $cargo, 'totalHombres' => $totalHombres, 'totalMujeres' => $totalMujeres,
            'totalEstudiantes' => $totalEstudiantes, 'estado' => $estado
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request)
    {
        //
    }
}
