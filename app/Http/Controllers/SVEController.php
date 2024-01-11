<?php

namespace App\Http\Controllers;

use App\Models\SVE;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Estudiante;
use App\Models\Postulante;
use App\Models\votacion;
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
        $votacion = votacion::where('id_estudiante', $estudiante->id)->first();

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

        switch ($component) {
            case 'estudiante':
                $data = Estudiante::paginate(20);
                break;
            case 'postulaciones':
                $data = Postulante::orderByRaw(" CASE
        WHEN cargo_postulante = 'Transición' THEN 1
        WHEN cargo_postulante = 'Primero' THEN 2
        WHEN cargo_postulante = 'Segundo' THEN 3
        WHEN cargo_postulante = 'Tercero' THEN 4
        WHEN cargo_postulante = 'Cuarto' THEN 5
        WHEN cargo_postulante = 'Quinto' THEN 6
        WHEN cargo_postulante = 'Sexto' THEN 7
        WHEN cargo_postulante = 'Séptimo' THEN 8
        WHEN cargo_postulante = 'Octavo' THEN 9
        WHEN cargo_postulante = 'Noveno' THEN 10
        WHEN cargo_postulante = 'Décimo' THEN 11
        WHEN cargo_postulante = 'Consejero' THEN 12
        WHEN cargo_postulante = 'Personero' THEN 13      
        END")->paginate(10); // carga todos los postulantes
                break;
            case 'conteovotos':
                $data = Postulante::all(); // Carga todos los datos de otro modelo
                break;
                // Agrega más casos según sea necesario...
            default:
                $data = [];
                break; // Datos por defecto
        }

        return view('dashboard', ['component' => $component, 'data' => $data]);
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
