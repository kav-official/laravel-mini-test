<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transection;

class ReportController extends Controller
{
    public function index(Request $request){
        $type = $request->monthtype ? $request->monthtype : '';
        $date = $request->dmy ? $request->dmy : '';

        $Y = explode('-',$date)[0];
        $M = explode('-',$date)[1];
       

        if($type == 'm'){
            $income  = Transection::where('type','income')->whereYear('created_at','=',$Y)->whereMonth('created_at','=',$M)->get();
            $expense = Transection::where('type','expense')->whereYear('created_at','=',$Y)->whereMonth('created_at','=',$M)->get();
        }
        if($type == 'y'){
            $income  = Transection::where('type','income')->whereYear('created_at','=',$Y)->get();
            $expense = Transection::where('type','expense')->whereYear('created_at','=',$Y)->get();
        }

        $response = ['success'=>true,'income'=>$income,'expense'=>$expense];

        return response()->json($response);
    }
}
