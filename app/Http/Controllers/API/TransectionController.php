<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\tblstore;

class TransectionController extends Controller
{
    public function index(Request $req){
    
        try {

            $type = $req->filterOption;
            $date = $req->dateFilter;

            if($req->dateFilter == ""){
                $data = Transection::orderBy('created_at','desc')
                ->paginate(10)
                ->toArray();
                return array_reverse($data);
            }else{
                $m = explode('-',$date)[1];
                $y = explode('-',$date)[0];
    
                if($type == 'M'){
                    $data = Transection::whereYear('created_at','=',$y)
                    ->whereMonth('created_at','=',$m)
                    ->orderBy('created_at','desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($data);
                }else{
                    $data = Transection::whereYear('created_at','=',$y)
                    ->orderBy('created_at','desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($data);
                }
            }

            $response = ['success'=>true,'message'=>'Success'];
        } catch (\Illuminate\Database\QueryException $ex){
            $response = ['success'=>false,'message'=>$ex->getMessage()];
        }
        return response()->json($response);
    }
    public function add(Request $req){
        try {
           
            foreach ($req->orderItem as $item) {
                $tran = Transection::all()->sortByDesc('id')->take(1)->toArray();
                $number = 1;
                foreach ($tran as $row) {
                    $number = $row['tran_id'];
                }
                if($number != ""){
                    $number1 = str_replace("INC","",$number);
                    $number2 = str_replace("EXP","",$number1);
                    $number  = (int)$number2+1;
                    $lenght  = 5;
                    $number  = substr(str_repeat(0,$lenght).$number, - $lenght);
                }
                if($req->acc_type =="income"){
                    $tnum = "INC";
                }elseif($req->acc_type == "expense"){
                    $tnum = "EXP"; 
                }
                $store = new Transection();
                $store->tran_id     = $tnum.$number;
                $store->product_id  = $item['id'];
                $store->type        = $req->acc_type;
                $store->description = $item['name'];
                $store->quantity    = $item['qty'];
                $store->price       = $item['sale_price'] * $item['qty'];
                $store->save();

                //update stock
                $store = tblstore::find($item['id']);
                $store_update = tblstore::where('id',$item['id']);
                $store_update->update([
                    'quantity' => $store->quantity - $item['qty']
                ]);
            }
            $success = true;
            $message = "Transection success";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = ['success'=>$success,'message'=>$message];
       return response()->json($response);
    }
}
