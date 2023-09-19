<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NaoSei;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Controllers;

class NaoSeiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosNaoSei = NaoSei::All();
        $contador = $dadosNaoSei->count();

        return 'Músicas: '.$contador.  $dadosNaoSei. Response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosNaoSei = $request->All();

        $valida = Validator::make($dadosNaoSei, [
            'nomeArtista'=> 'required',
            'marcaMusica'=> 'required',
        ]);

        if($valida->fails()){
            return 'Dados inválidos'.$valida->errors(true). 500;
        }
            $NaoSeiBanco = NaoSei::create($dadosNaoSei);
        if($NaoSeiBanco){
            return 'Músicas cadastradas '.Response()->json([], Response::HTTP_NO_CONTENT); 
        }else{
            return 'Músicas não cadastradas '.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $NaoSeiBanco = NaoSei::find($id);
        $contador = $NaoSeiBanco->count();

        if($NaoSeiBanco){
            return 'Músicas encontradas: '.$contador.' - '.$NaoSeiBanco.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'Músicas não localizadas.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $NaoSeiDados = $request->All();

        $valida = Validator::make($NaoSeiDados,[
            'nomeArtista'=> 'required',
            'marcaMusica'=> 'required',
        ]);

        if($valida->fails()){
            return 'Dados incompletos'.$valida->errors(true). 500;
        }

        $NaoSeiBanco = NaoSei::find($id);
        $NaoSeiBanco->nomeArtista = $NaoSeiDados['nomeArtista'];
        $NaoSeiBanco->nomeMusica = $NaoSeiDados['nomeMusica'];

        $RegistrosNaoSei = $NaoSeiBanco->save();
        if($RegistrosNaoSei){
            return 'Dados alterados com sucesso.'.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{  
            return 'Dados não alterados no banco de dados'.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $NaoSeiBanco = NaoSei::find($id);
        if($NaoSeiBanco){
            $NaoSeiBanco->delete();
            return 'A música foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'A música Não foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }
}