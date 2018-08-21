<?php
namespace App\Http\Controllers;

use App\Product;
// use App\Order;	// to put purchases from cart into DB
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use Session;
use Auth;


class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);  # create 'products' var in view
    }
    public function getAddToCart(Request $request, $id) {
        // Req param so, Laravel auto inject Request, id param supplied by route
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        
        $cart = new Cart($oldCart);
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);  //rather than pass product, more flexible to pass id
        // some new (unlisted) products might not have an id
        $request->session()->put('cart', $cart); 	// could use Session::put
        // debug: dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }
    
    public function getReduceByOne($id) {
        // remove/subtract one of the given items out of the cart
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
            
        if (count($cart->items) >0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        return redirect()->route('product.shoppingCart');
    }
    
    public function getRemoveItem($id) {
        // remove/subtract all of the given item out of the cart
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        
        if (count($cart->items) >0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        Session::put('cart', $cart);
        return redirect()->route('product.shoppingCart');
    }
    
    public function getCart() {
        if (!Session::has('cart')) {	// NO cart in session
            return view('shop.shopping-cart');
            // he took this out because theres check for cart in view: , ['products' => null]
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items,
            'totalPrice' => $cart->totalPrice]);
    }
}
