<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coche;
class CocheController extends Controller
{
    public function index()
    {
        return Coche::all();
    }

    // Crear un nuevo coche
    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio_noche' => 'required|numeric',
        ]);

        // Crear el coche
        $coche = Coche::create($validated);

        // Retornar el coche creado como respuesta
        return response()->json($coche, 201);
    }

    // Mostrar un coche específico
    public function show($id)
    {
        return Coche::findOrFail($id);
    }

    // Actualizar un coche específico
    public function update(Request $request, $id)
    {
        $coche = Coche::findOrFail($id);
        $coche->update($request->all());

        return $coche;
    }

    // Eliminar un coche
    public function destroy($id)
    {
        return Coche::destroy($id);
    }
}
