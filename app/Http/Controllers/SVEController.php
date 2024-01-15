<?php

namespace App\Http\Controllers;

use App\Models\SVE;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Curso;
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
        $numeroIdentidad = $request->input('numeroIdentidad');
        // return $numeroIdentidad;
        $estudiante = Estudiante::where('numeroIdentificacion', $numeroIdentidad)->where('estado', '0')->first();

        // return $estudiante;

        // Verificar si el estudiante existe
        if (!$estudiante) {
            session()->flash('message', 'El estudiante con el número de identidad ' . $numeroIdentidad . ', no existe en la base de datos. Verifique e intente nuevamente.');
            session()->flash('status', 'error');
            return redirect()->back();
        }

        // Verificar si el estudiante ya ha votado
        $votacion = Voto::where('id_estudiante', $estudiante->id)->first();

        // return $votacion;
        //verificar si el estudiante ya ha votado y completado su votacion 
        if ($votacion && $votacion->representante_curso == '1' && $votacion->contralor == '1' && $votacion->personero == '1') {
            session()->flash('message', 'El estudiante con el número de identidad ' . $numeroIdentidad . ', ya ha votado y completado su votación.');
            session()->flash('status', 'warning');
            return redirect()->back();
        }

        $postulantes = Postulante::where('estado_postulante', '0')->get();
        if (!$postulantes || $postulantes->count() == 0) {
            session()->flash('message', 'El sistema de votacion no tiene postulantes registrados. Comuniquese con el administrador del sistema.');
            session()->flash('status', 'error');
            return redirect()->back();
        }
        // return $postulantes;

        session()->flash('message', 'El estudiante con el número de identidad ' . $numeroIdentidad . ', puede votar.');
        session()->flash('status', 'success');

        // Verificar si el estudiante ya ha votado y no ha completado su votacion
        $cargos = Cargo::with(['postulantes' => function ($query) {
            $query->join('cargos', 'postulantes.cargo_id', '=', 'cargos.id')
                ->select('postulantes.*', 'cargos.nombre_cargo')
                ->orderByRaw("CASE
                    WHEN cargos.nombre_cargo = 'Representante de Curso' THEN 1
                    WHEN cargos.nombre_cargo = 'Contralor' THEN 2
                    WHEN cargos.nombre_cargo = 'Personero' THEN 3
                    ELSE 4 END");
        }])->get();

        // return $cargos;

        return view('SistemaVotacion.index', ['cargos' => $cargos, 'postulantes' => $postulantes, 'estudiante' => $estudiante]);
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
        $curso = Curso::all();
        $cargo = Cargo::all();
        $photo = Photo::all();


        // return $cargo;

        switch ($component) {
            case 'estudiante':
                $data = Estudiante::with('curso', 'estado',)->paginate(20);
                // return $data;
                break;
            case 'postulaciones':
            case 'postulaciones':
                $data = Postulante::with('cargo', 'estudiante.curso', 'photo')->paginate(10);
                break;
            case 'conteovotos':
                $data = Postulante::all();
                break;
                // Agrega más casos según sea necesario...
            default:
                $data = [];
                break; // Datos por defecto
        }

        return view('dashboard', [
            'component' => $component, 'data' => $data, 'curso' => $curso,
            'cargo' => $cargo, 'totalHombres' => $totalHombres, 'totalMujeres' => $totalMujeres,
            'totalEstudiantes' => $totalEstudiantes,
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
