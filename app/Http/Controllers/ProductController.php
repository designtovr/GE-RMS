<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddProductRequest;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function Products(Request $request)
    {
    	$products = ProductMaster::selectRaw('ma_product.id, ma_product.part_no, ma_product.description, pt.name as type_name, pt.category, ma_product.type')->leftJoin('ma_product_type as pt', 'pt.id', 'ma_product.type')->orderBy('ma_product.id')->get();
    	return response()->json(['data' => $products, 'status' => 'success']);
    }

    public function AddProduct(AddProductRequest $request)
    {
    	$product = $request->get('product');
        if (array_key_exists('id', $product))
        {
            $PD = ProductMaster::find($product['id']);
            $PD->part_no = $product['part_no'];
            if (array_key_exists('description', $product))
                $PD->description = $product['description'];
            $PD->type = $product['type'];
            $PD->updated_by = Auth::id();
            $PD->updated_at = Carbon::now();
            $PD->update();

            return response()->json(['data' => $product, 'status' => 'success', 'message' => 'Product Updated Successfully'], 200);
        }
        else
        {
            $PD = ProductMaster::where('part_no', $product['part_no'])->first();
            if($PD)
                return response()->json(['data' => $product, 'status' => 'failure', 'message' => 'Model No Already Exists'], 200);

            $PD = new ProductMaster();
            $PD->part_no = $product['part_no'];
            $PD->description = (array_key_exists('description', $product))?$product['description']:'';
            $PD->type = $product['type'];
            $PD->created_by = Auth::id();
            $PD->updated_by = Auth::id();
            $PD->save();

            return response()->json(['data' => $product, 'status' => 'success', 'message' => 'Product Added Successfully'], 200);
        }
    }

    public function ProductsOfType($producttype_id)
    {
        $products = ProductMaster::selectRaw('ma_product.id, ma_product.part_no')->where('type',$producttype_id)->orderBy('ma_product.id')->get();
        return response()->json(['data' => $products, 'status' => 'success']);
    }

    public function DeleteProduct($id)
    {
        ProductMaster::destroy($id);
        return response()->json([ 'status' => 'success', 'message' => 'Product Deleted Successfully']);
    }
}
