<?php

namespace App\Http\Controllers;

use App\Author;
use App\Brand;
use App\Category;
use App\Publisher;
use App\SimpleProduct;
use Illuminate\Http\Request;

use DB;
use function GuzzleHttp\Promise\all;

class AllProductController extends Controller
{
    public function all_product($id=null,$pog=null)
    {
//        return [$id,$pog];
        $slauthor[]=null;
        if ($pog == 'main'){
            $products=SimpleProduct::where('status','1')->where('category_id',$id)->get();
        }elseif ($pog == 'sub'){
            $products=SimpleProduct::where('status','1')->where('subcategory_id',$id)->get();
        }elseif ($pog == 'child'){
            $products=SimpleProduct::where('status','1')->where('child_id',$id)->get();
        }elseif ($pog == 'author'){
            $products=SimpleProduct::where('status','1')->where('author_id',$id)->get();
        }elseif ($pog == 'publish'){
            $products=SimpleProduct::where('status','1')->where('publisher_id',$id)->get();
        }else{
            $products=SimpleProduct::where('status','1')->get();
        }

//        return $author;
        return view('frontend.pages.all_product',[
            'products'=>$products,
            'authors'=>Author::where('status','1')->get(),
            'publishers'=>Publisher::where('status','1')->get(),
//            'categories'=> [],
//            'selectauthors'=>[],
//            'selectpublishers'=>[],
        ]);
    }

    public function filter_product(Request $request)
    {
//        return $request->categories;
//        $a=explode(str_replace(',','',$request->authors));
//        return $a;
        $products=SimpleProduct::where('status','1');
//        $products=$products->whereIn('category_id',$request->categories);
//        return $products;
        if (isset($request->categories)){
            $products=$products->whereIn('category_id',$request->categories);
//            return $products;
        }
        if (isset($request->authors)){
            $products=$products->whereIn('author_id',$request->authors);
//            return $products;
        }
        if (isset($request->publishers)){
            $products=$products->whereIn('publisher_id',$request->publishers);
//            return $products;
        }
//        else{
            $products=$products->paginate(12);
//        }



//        if ($request->categories){
//            $categories=$request->categories;
//           $categoriProduct= SimpleProduct::whereIn('category_id',$categories)->where('status','1');
//        }else{
//            $categories=[];
//        }
//        if ($request->brands){
//            $brands=$request->brands;
//        }else{
//            $brands=[];
//        }
//        if ($request->authors){
//            $authors=$request->authors;
//            $authorsProduct= SimpleProduct::whereIn('author_id',$authors)->where('status','1')->get();
//        }else{
//            $authors=[];
//        }
//        if ($request->publishers){
//            $publishers=$request->publishers;
//            $publisherProduct= SimpleProduct::whereIn('publisher_id',$publishers)->where('status','1');
//        }else{
//            $publishers=[];
//         }
//
////        if ($request->categories && ($request->authors || $request->publishers)){
//        if ($request->categories ){
//            if ($request->authors || $request->publishers){
//                $products=$categoriProduct->WhereIn('author_id',$authors)
//                    ->orWhereIn ('publisher_id',$publishers)
//                    //                ->where('status','1')
//                    ->get();
//            }else{
//                $products=$categoriProduct->get();
//            }
//
//        } else{
//            $products=SimpleProduct::whereIn('author_id',$authors)
//                                    ->orWhereIn ('publisher_id',$publishers)
//                                    ->where('status','1')
//                                    ->get();
//        }





//        $allproducts[]=$products;
//        $product=SimpleProduct::whereIn('publisher_id',$publisher)
//                                ->orwhereIn('publisher_id',$publisher)
//                                ->get();

//        $allproduct=SimpleProduct::whereBetween($sproduct,[$products,$product])->get();
//        $allproducts[]=$product;
//        dd($products);
//        return $products;
        return view('frontend.pages.all_product',[
            'products'=>$products,
//            'authors'=>Author::whereNotIn('author_id',$request->authors)->where('status','1')->get(),
            'selectcategories'=> $request->categories,
            'selectauthors'=>$request->authors,
            'selectpublishers'=>$request->publishers,
        ]);
    }

    public function all_authors()
    {
        return view('frontend.pages.all_author',[
            'authors'=>Author::where('status','1')->get()
        ]);
    }

    public function all_publishers()
    {
        return view('frontend.pages.all_publisher',[
            'publishers'=>Publisher::where('status','1')->get()
        ]);
    }
    public function all_category()
    {
        return view('frontend.pages.all_category',[
            'categories'=>Category::where('status','1')->get()
        ]);
    }


}
