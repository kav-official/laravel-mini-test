<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblstore;
use App\Models\Transection;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    public function index(){
        $filter = \Request::get('filter');
        $store = tblstore::orderBy('created_at','DESC')
        ->where("name","LIKE","%{$filter}%")
        ->paginate(5)
        ->toArray();
        return array_reverse($store);
        // ->get();
        // return $store;
    }

    public function add(Request $request){
        try {

            if($request->file('image')){
                $uploads_path = 'assets/images';
                $image_path     = time() . '.' . $request->image->getClientOriginalExtension();
                $image        = $request->file('image');
                $img = Image::make($image->getRealPath());
                $img->resize(800,null,function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($uploads_path.'/'.$image_path);
            }else{
                $image_path = "";
            }

            $tbl             = new tblstore();
            $tbl->name       = $request->name;
            $tbl->image      = $image_path;
            $tbl->quantity   = $request->quantity;
            $tbl->base_price = $request->base_price;
            $tbl->sale_price = $request->sale_price;
            $tbl->save();
            $product_id = $tbl->id;

            //store payment
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
            if($request->acc_type =="income"){
                $tnum = "INC";
            }elseif($request->acc_type == "expense"){
                $tnum = "EXP"; 
            }
            $store = new Transection();
            $store->tran_id     = $tnum.$number;
            $store->product_id  = $product_id;
            $store->type        = $request->acc_type;
            $store->description = 'new '.$request->name;
            $store->quantity    = $request->quantity;
            $store->price       = $request->base_price * $request->quantity;
            $store->save();
            //end store payment

            $success = true;
            $message = $request->name.'have added';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = ['success'=>$success,'message'=>$message];
        return response()->json($response);
    }

    public function edit($id){
        $store = tblstore::find($id);
        return response()->json($store);
    }
    public function update($id, Request $request){

        $store = tblstore::find($id);

        if($request->file('image')){
            $uploads_path = 'assets/images';
              // Remove image
              if($store->images!='' && $store->images!= null){
                if(file_exists('assets/images/'.$store->images)){
                unlink('assets/images/'.$store->images);
                }
            }

            $image_path     = time() . '.' . $request->image->getClientOriginalExtension();
            $image          = $request->file('image');
            $img = Image::make($image->getRealPath());
            $img->resize(800,null,function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($uploads_path.'/'.$image_path);
        }else{
            $image_path = "";
        }

        $store->update([
            "name"       => $request->name,
            "image"      => $image_path,
            "quantity"   => $request->quantity,
            "base_price" => $request->base_price,
            "sale_price" => $request->sale_price
        ]);
    }
    public function delete($id){
        $store = tblstore::find($id);
        $store->delete();
    }
}
