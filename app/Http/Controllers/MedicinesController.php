<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Medicine;

class MedicinesController extends Controller
{
    public function index(){
        try{
            $medicines = Medicine::all();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response($medicines, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // 'name', 'urlImage', 'description', 'dosage'
        try {
            if($request->name==null||$request->urlImage==null||$request->description==null||$request->dosage==null){
                return response('Need more data', 409);
            }
            $medicine = new Medicine;
            $medicine->name = $request->name;
            $medicine->urlImage = $request->urlImage;
            $medicine->description = $request->description;
            $medicine->dosage = $request->dosage;
            $medicine->save();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response('Medicamento creado', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ele, $val) {
        try{
            $response = Medicine::where($ele,$val)->get();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return count($response) > 0? response($response, 200): response('No se encontro el medicamento', 404);
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
            $medicine = Medicine::findOrFail($id);
            if($request->name!=null){
                $medicine->name = $request->name;
            }if($request->urlImage!=null){
                $medicine->urlImage = $request->urlImage;
            }if($request->description!=null){
                $medicine->description = $request->description;
            }if($request->dosage!=null){
                $medicine->dosage = $request->dosage;
            }
            $medicine->save();
        }catch(Exception $e) {
            response('No se encontro el medicamento', 404);
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
            $medicine = Medicine::findOrFail($id);
            $medicine->delete();
    
            return response("El medicamento ha sido borrado",200);
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
    }
}
