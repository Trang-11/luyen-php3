<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    //
    public function index()
    {
        //
        $data = Game::query()->latest('id')->paginate(5);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        //
        $data = $request->except('cover_art');

        try {
            DB::transaction(function () use ($request, &$data) {
                if ($request->hasFile('cover_art')) {
                    $data['cover_art'] = Storage::put('games', $request->file('cover_art'));
                }

                Game::create($data);
            }, 3);
            return response()->json([
                'message' => 'Game created successfully',
                'data' => $data
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
        return view('layouts.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        //
        Game::findOrFail($game->id) ;
        $data = $request->except('cover_art');

        if ($request->hasFile('cover_art')) {
            $data['cover_art'] = Storage::put('games', $request->file('cover_art'));
        }
        $current_img = $game->cover_art;
        $game->update($data);

        if ($request->hasFile('cover_art') && $current_img && Storage::exists($current_img)) {
            Storage::delete($current_img);
        }

        return response()->json([
            'message' => 'Game updated successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        
        $game->delete();
        return response()->json([
            'message' => 'Game deleted successfully'
            ], Response::HTTP_OK);
        
    }

}
