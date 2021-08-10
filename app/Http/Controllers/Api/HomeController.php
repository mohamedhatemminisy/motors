<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function home(Request $request){
        if($request->date == 'today'){
            $products = Product::where('pieceName',$request->type)->
            whereDate('created_at', Carbon::today())->get();
        }elseif($request->date == 'yesterday'){
            $products = Product::where('pieceName',$request->type)
            ->whereDate('created_at', Carbon::yesterday())->get();
        }elseif($request->date == 'day_before_yesterday'){
            $products = Product::where('pieceName',$request->type)
            ->whereDate('created_at', Carbon::now()->subDays(2))->get();
        }

        foreach($products as $product){
            $arr['id ']=  $product->id ;
            $arr['brandName']=  $product->brandName;
            $arr['modelName']=  $product->modelName;
            $arr['modelNumber']=  $product->modelNumber;
            $arr['pieceName']=  $product->pieceName;
            $arr['signNumber']=  $product->signNumber;
            $arr['status']=  $product->status;
            $data[]=$arr;
        }
        $page = $request->get('page', 1);
        // default number per page
        $perPage = 50;
        // offset results
        $offset = ($page * $perPage) - $perPage;

        $count = count($arr);
        return new LengthAwarePaginator($data, $count, $perPage, $offset);

    }
}
