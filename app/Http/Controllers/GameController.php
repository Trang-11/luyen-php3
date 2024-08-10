<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Game::query()->latest('id')->paginate(5);
        return view('layouts.index', compact('data'));
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
            return redirect()->route('games.index')->with('success', 'Game created successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('games.index')->with('error', $th->getMessage());
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

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        
        $game->delete();
        return back()->with('success', "Xoá thành công");
    }

    
}
