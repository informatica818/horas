<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use Illuminate\Http\Request;

class HorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Este método devuelve una vista que muestra todas las horas registradas por el usuario
     * autenticado. El total de cantidad por cada ámbito se calcula en el controlador y se envía
     * a la vista como una variable.
     */
    public function index()
    {
        $hours = Hora::where('user_id', auth()->id())->get();
        $totalsByAmbito = $hours->groupBy('ambito')->map(function ($group) {
            return $group->sum('cantidad');
        });
        
        return view('Horas.index', compact('hours', 'totalsByAmbito'));
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostar la vista de creación de una nueva hora
        return view('Horas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'ambito' => 'required|string|max:255',
        'archivo' => 'required|file|mimes:pdf|max:512',
        'cantidad' => 'required|integer',
    ]);

    // Convertir el archivo a binario
    $archivoBinario = file_get_contents($request->file('archivo')->getRealPath());

    // Crear el registro
    Hora::create([
        'titulo' => $request->input('titulo'),
        'ambito' => $request->input('ambito'),
        'archivo' => $archivoBinario,
        'cantidad' => $request->input('cantidad'),
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Constancia guardada correctamente');
}

public function descargarArchivo($id)
{
    $hora = Hora::findOrFail($id);

    // Verifica si el archivo existe
    if (!$hora->archivo) {
        return redirect()->back()->with('error', 'El archivo no está disponible');
    }

    return response($hora->archivo)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="archivo.pdf"');
}


    public function edit(string $id)
    {
        $hora = Hora::findOrFail($id);
        return view('Horas.edit', compact('hora'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hora = Hora::findOrFail($id);
        $hora->delete();
        return redirect()->back()->with('success', 'Constancia Eliminada Correctamente');
    }
    
}
