<?php

namespace App\Http\Controllers;


use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\HogarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FamiliaController;
use App\Models\Ciudad;
use Illuminate\Http\Request;
class EncuestaController extends Controller
{
    public function mostrarEncuesta(Request $request)
    {
        $departamentos = DepartamentoController::listarDepartamentos();
        $ciudades = [];

        // Verifica si hay un departamento seleccionado para mostrar sus ciudades
        $departamentoSeleccionado = $request->input('departamento_id');
        if ($departamentoSeleccionado) {
            $ciudades = CiudadController::listarCiudadesPorDepartamento($departamentoSeleccionado);
        }

        return view('encuesta.encuesta', [
            'departamentos' => $departamentos,
            'ciudades' => $ciudades,
            'departamentoSeleccionado' => $departamentoSeleccionado,
        ]);
    }

    public function guardarEncuesta(Request $request)
    {
        // Guardar los datos de la encuesta
        $hogarId = HogarController::crearHogar($request);
        ServicioController::guardarServicios($hogarId, $request->input('servicios', []));
        $usuarioId = UsuarioController::crearUsuario($hogarId, $request);

        if (!$request->vive_con_familia && $request->tipo_familiar) {
            FamiliaController::crearFamiliar($usuarioId, $request);
        }

        // Redirige al análisis de carencia
        return redirect()->route('encuesta.analisis', ['departamento_id' => $request->departamento_id]);
    }

    public function analizarEncuesta(Request $request)
    {
        // Llama al método del DepartamentoController para analizar carencia por departamento
        return DepartamentoController::analizarCarenciaPorDepartamento($request->departamento_id);
    }

    public function obtenerCiudadesPorDepartamento($departamento_id)
    {
        $ciudades = Ciudad::where('departamento_id', $departamento_id)->get();
        return response()->json($ciudades);
    }

    
}