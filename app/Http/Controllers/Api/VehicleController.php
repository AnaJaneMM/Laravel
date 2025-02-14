<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Mostrar todos los vehículos con su seguro.
     */
    public function index()
    {
        return Vehicle::with('insurance')->get();
    }

    /**
     * Guardar un nuevo vehículo en la base de datos.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'license_plate' => 'required|unique:vehicles',
                'brand' => 'required',
                'model' => 'required',
                'year' => 'required|integer',
            ]);

            $vehicle = Vehicle::create($request->all());
            return response()->json($vehicle, 201);

        } catch (\Exception $e) {
            Log::error('Error al guardar el vehículo: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo guardar el vehículo'], 500);
        }
    }

    /**
     * Mostrar un vehículo específico con su seguro.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::with('insurance')->findOrFail($id);
        return response()->json($vehicle);
    }

    /**
     * Actualizar un vehículo.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());
        return response()->json($vehicle);
    }

    /**
     * Eliminar un vehículo.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return response()->json(null, 204);
    }
}
