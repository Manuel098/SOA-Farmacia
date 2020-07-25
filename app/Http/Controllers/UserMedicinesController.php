<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\UserMedicine as UsMe;

class UserMedicinesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
        try{
            $usMe = UsMe::where('user_id', $id)
            ->orderBy('price', 'asc')
            ->with('user','medicine')
            ->get();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response($usMe, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            if($request->price==null||$request->user_id==null||$request->medicine_id==null){
                return response('Need more data', 409);
            }
            $usMe = new UsMe;
            $usMe->price = $request->price;
            $usMe->user_id = $request->user_id;
            $usMe->medicine_id = $request->medicine_id;
            $usMe->save();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response('Relacion creada', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ele, $val, $id) {
        try{
            $Data= array();
            $response = UsMe::where($ele,$val)
            ->orderBy('price', 'asc')
            ->with('user','medicine')
            ->get();
            foreach ($response as $medicine) {
                if($medicine->user->id == $id){
                    array_push($Data, $medicine);
                }
            }
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return count($response) > 0? response($Data, 200): response('No se encontro el registro', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try{
            $usMe = UsMe::findOrFail($id);
            if($request->price!=null){
                $usMe->price = $request->price;
            }if($request->user_id!=null){
                $usMe->user_id = $request->user_id;
            }if($request->medicine_id!=null){
                $usMe->medicine_id = $request->medicine_id;
            }
            $usMe->save();
        }catch(Exception $e) {
            response('No se encontro el registro', 404);
        }
        return response('Actualización completa', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try{
            $usMe = UsMe::findOrFail($id);
            $usMe->delete();
    
            return response("La relación ha sido borrado",200);
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
    }
}
