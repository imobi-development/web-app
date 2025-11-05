<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request) {
        $properties = Property::all();
        return response()->json($properties);
    }

    public function store(Request $request) {
        $property = Property::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($property);
    }
}
