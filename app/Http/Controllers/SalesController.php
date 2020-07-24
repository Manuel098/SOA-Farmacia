<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Sale;

class SalesController extends Controller {
    /**
     * Display a listing of the sells in a day, month or year.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
        try{
            $Data= array();
            $sales = Sale::where('id','>',0)
                ->with('userMedicine.medicine','userMedicine.user')
                ->get();
            foreach ($sales as $sale) {
                if($sale->userMedicine->user->id == $id){
                    array_push($Data, $sale);
                }
            }
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return count($Data) > 0 ? response($Data, 200) : response('No hubo ventas', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            if($request->amount==null||$request->user_medicine_id==null){
                return response('Need more data', 409);
            }
            $sale = new Sale;
            $sale->amount = $request->amount;
            $sale->user_medicine_id = $request->user_medicine_id;
            $sale->save();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response('Venta realizada', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($tipe, $value, $id) {
        try{
            $Data= array();
            switch ($tipe) {
                case 'day':
                    $sales = Sale::whereDay('created_at', strval($value))
                        ->with('userMedicine.medicine','userMedicine.user')
                        ->get();
                    break;
                case 'month':
                    $sales = Sale::whereMonth('created_at', strval($value))
                        ->with('userMedicine.medicine','userMedicine.user')
                        ->get();
                    break;
                case 'year':
                    $sales = Sale::whereYear('created_at', strval($value))
                        ->with('userMedicine.medicine','userMedicine.user')
                        ->get();
                    break;
            }
            foreach ($sales as $sale) {
                if($sale->userMedicine->user->id == $id){
                    array_push($Data, $sale);
                }
            }
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return count($Data) > 0 ? response($Data, 200) : response('No hubo ventas esa fecha', 200);
    }

    /**
     * Display the resource for medicineId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forMedicine($uId, $mId) {
        try{
            $Data= array();
            $sales = Sale::where('id','>',0)
                ->with('userMedicine.medicine','userMedicine.user')
                ->get();
            foreach ($sales as $sale) {
                if($sale->userMedicine->user->id == $uId && $sale->userMedicine->medicine->id == $mId){
                    array_push($Data, $sale);
                }
            }
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return count($Data) > 0 ? response($Data, 200) : response('No hubo ventas de ese producto', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try{
            $sale = Sale::findOrFail($id);
            $sale->delete();
    
            return response("La venta ha sido borrada",200);
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
    }
}
