<?php

namespace App\Http\Controllers\Api;

use App\Models\Insurance;
use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return Insurance::with('vehicle')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|unique:insurances|exists:vehicles,id',
            'insurance_company' => 'required',
            'expiration_date' => 'required|date',
        ]);

        $insurance = Insurance::create($request->all());
        return response()->json($insurance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return $insurance->load('vehicle');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $insurance->update($request->all());
        return response()->json($insurance);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $insurance->delete();
        return response()->json(null, 204);
    }
}
