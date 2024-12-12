<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public static function listarDepartamentos()
    {
        return Departamento::all(); // Obtener todos los departamentos de la base de datos
    }

    public static function analizarCarenciaPorDepartamento($departamentoId)
    {
        // Ruta al archivo JSON de carencia médica
        $carenciaJsonPath = public_path('json/carencia_medica.json'); // Ajusta si es necesario
        if (!file_exists($carenciaJsonPath)) {
            return response()->json(['message' => 'Archivo de datos de carencia médica no encontrado.'], 500);
        }

        // Cargar los datos del archivo JSON de carencia médica
        $carenciaData = json_decode(file_get_contents($carenciaJsonPath), true);

        // Ruta al archivo JSON de obesidad
        $obesidadJsonPath = public_path('json/obesidad.json'); // Ajusta si es necesario
        if (!file_exists($obesidadJsonPath)) {
            return response()->json(['message' => 'Archivo de datos de obesidad no encontrado.'], 500);
        }

        // Cargar los datos del archivo JSON de obesidad
        $obesidadData = json_decode(file_get_contents($obesidadJsonPath), true);

        // Ruta al archivo JSON de enfermedades crónicas
        $enfermedadesCronicasJsonPath = public_path('json/poblacion_enfermedades_cronicas.json'); // Ajusta si es necesario
        if (!file_exists($enfermedadesCronicasJsonPath)) {
            return response()->json(['message' => 'Archivo de datos de enfermedades crónicas no encontrado.'], 500);
        }

        // Cargar los datos del archivo JSON de enfermedades crónicas
        $enfermedadesCronicasData = json_decode(file_get_contents($enfermedadesCronicasJsonPath), true);

        // Obtener todos los departamentos
        $departamentos = Departamento::all();

        // Obtener el nombre del departamento seleccionado
        $departamento = Departamento::find($departamentoId);
        $departamentoNombre = $departamento->nombre_departamento ?? null;

        // Verificar si el departamento seleccionado tiene datos en el JSON de carencia médica
        $carenciaDepartamento = $departamentoNombre && isset($carenciaData['carencia_medica']['departamentos'][$departamentoNombre])
            ? $carenciaData['carencia_medica']['departamentos'][$departamentoNombre]
            : null;

        // Verificar si el departamento seleccionado tiene datos en el JSON de obesidad
        $obesidadDepartamento = $departamentoNombre && isset($obesidadData['obesidad']['departamentos'][$departamentoNombre])
            ? $obesidadData['obesidad']['departamentos'][$departamentoNombre]
            : null;

        // Verificar si el departamento seleccionado tiene datos en el JSON de enfermedades crónicas
        $enfermedadesCronicasDepartamento = $departamentoNombre && isset($enfermedadesCronicasData['poblacion_enfermedades_cronicas']['departamentos'][$departamentoNombre])
            ? $enfermedadesCronicasData['poblacion_enfermedades_cronicas']['departamentos'][$departamentoNombre]
            : null;

        // Obtener todos los porcentajes de carencia médica, obesidad y enfermedades crónicas
        $carencias = $carenciaData['carencia_medica']['departamentos'];
        $obesidades = $obesidadData['obesidad']['departamentos'];
        $enfermedadesCronicas = $enfermedadesCronicasData['poblacion_enfermedades_cronicas']['departamentos'];

        // Pasar los datos a la vista
        return view('encuesta.analisis', [
            'departamentos' => $departamentos,
            'carencias' => $carencias,
            'obesidades' => $obesidades,
            'enfermedadesCronicas' => $enfermedadesCronicas,
            'departamentoSeleccionado' => $departamentoNombre,
            'carenciaDepartamento' => $carenciaDepartamento,
            'obesidadDepartamento' => $obesidadDepartamento,
            'enfermedadesCronicasDepartamento' => $enfermedadesCronicasDepartamento,
            'nacionalCarencia' => $carenciaData['carencia_medica']['grupos_vulnerables']['Nacional'],
            'nacionalObesidad' => $obesidadData['obesidad']['grupos_vulnerables']['Nacional'],
            'nacionalEnfermedadesCronicas' => $enfermedadesCronicasData['poblacion_enfermedades_cronicas']['grupos_vulnerables']['Nacional'],
        ]);
    }
}



