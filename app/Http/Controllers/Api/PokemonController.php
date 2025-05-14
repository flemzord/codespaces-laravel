<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pokemon;
use Illuminate\Support\Facades\Validator;


class PokemonController extends Controller
{
    //index: obtiene todos los pokemones
    public function index()
    {
        $pokemons = pokemon::all();
        return response()->json(['pokemons' => $pokemons], 200);
    }
    //show: obtiene un pokemon por id
    public function show($id)
    {
        $pokemon = pokemon::find($id);
        if ($pokemon) {
            return response()->json(['pokemon' => $pokemon], 200);
        } else {
            return response()->json(['message' => 'Pokemon not found'], 404);
        }
    }
    //store: crea un nuevo pokemon
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|string|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $pokemon = pokemon::create($request->all());
        return response()->json(['pokemon' => $pokemon], 201);
    }
    //update: actualiza un pokemon por id
    public function update(Request $request, $id)
    {
        $pokemon = pokemon::find($id);
        if ($pokemon) {
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'image' => 'url',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $pokemon->update($request->all());
            return response()->json(['pokemon' => $pokemon], 200);
        } else {
            return response()->json(['message' => 'Pokemon not found'], 404);
        }
    }
    //updatePartial: actualiza parcialmente un pokemon por id
    public function updatePartial(Request $request, $id)
    {
        $pokemon = pokemon::find($id);
        if ($pokemon) {
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'image' => 'url',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $pokemon->update($request->only(array_keys($request->all())));
            return response()->json(['pokemon' => $pokemon], 200);
        } else {
            return response()->json(['message' => 'Pokemon not found'], 404);
        }
    }
    //destroy: elimina un pokemon por id
    public function destroy($id)
    {
        $pokemon = pokemon::find($id);
        if ($pokemon) {
            $pokemon->delete();
            return response()->json(['message' => 'Pokemon deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Pokemon not found'], 404);
        }
    }
}
