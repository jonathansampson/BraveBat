<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'url' => 'required',
            'accept' => 'required',
        ]);
        $user = auth()->user();
        $user->tokens()->delete();
        $plainTextToken = $user->createToken('api')->plainTextToken;
        $token = $user->tokens->first();
        $token->url = $request->url;
        $token->project = $request->project;
        $token->description = $request->description;
        $token->save();
        session()->flash('status', "Your BraveBat API token is <p class='font-bold select-all'>{$plainTextToken}</p>. It will not be shown again. Please copy and store it safely.");
        return back();
    }

    public function update()
    {
        $user = auth()->user();
        $token = $user->tokens->first();
        $randomString = Str::random(80);
        $token->token = hash('sha256', $randomString);
        $token->save();
        $plainTextToken = $token->id . '|' . $randomString;
        session()->flash('status', "Your BraveBat API token is <p class='font-bold select-all'>{$plainTextToken}</p>. It will not be shown again. Please copy and store it safely.");
        return back();
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        session()->flash('status', "Your token has been deleted.");
        return back();
    }
}
