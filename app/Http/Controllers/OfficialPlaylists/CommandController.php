<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficialPlaylists\CreateCommandRequest;
use App\Http\Requests\OfficialPlaylists\UpdateCommandRequest;
use App\OfficialPlaylists\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommandController extends Controller
{
    /**
     * Display a listing of the commands.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commands = Command::orderBy('command')->get();

        return view('official-playlists.commands.index', compact('commands'));
    }

    /**
     * Show the form for creating a new command.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('official-playlists.commands.create');
    }

    /**
     * Store a newly created command in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\CreateCommandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommandRequest $request)
    {
        $command = Command::create([
            'command' => request('command'),
            'slug' => Str::slug(request('command') . ' ' . random_int(10000, 99999)),
        ]);

        return redirect()->route('official-playlists.commands.show', $command)
                         ->with('status', __('Command added!'));
    }

    /**
     * Display the specified command.
     *
     * @param  \App\OfficialPlaylists\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function show(Command $command)
    {
        return view('official-playlists.commands.show', compact('command'));
    }

    /**
     * Show the form for editing the specified command.
     *
     * @param  \App\OfficialPlaylists\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function edit(Command $command)
    {
        return view('official-playlists.commands.edit', compact('command'));
    }

    /**
     * Update the specified command in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\UpdateCommandRequest  $request
     * @param  \App\OfficialPlaylists\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandRequest $request, Command $command)
    {
        $attributes = [
            'command' => request('command-string'),
        ];

        if (request('command-string') !== $command->command) {
            $attributes['slug'] = Str::slug(request('command-string') . ' ' . random_int(10000, 99999));
        }

        $command->update($attributes);

        return redirect()->route('official-playlists.commands.show', $command)
                         ->with('status', __('Command updated!'));
    }

    /**
     * Remove the specified command from storage.
     *
     * @param  \App\OfficialPlaylists\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function destroy(Command $command)
    {
        $command->delete();

        return redirect()->route('official-playlists.commands.index')
                         ->with('status', __('Command removed!'));
    }
}
