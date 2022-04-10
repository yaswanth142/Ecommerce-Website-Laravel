<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\user;

use App\Models\productitems;

use App\Models\Cart;

use App\Models\Order;



class HomeController extends Controller
{
   public function redirect()
   {
       $usertype=Auth::user()->usertype;
       if($usertype=='1')
       {
           return view('admin.home');
       }
       else{
          
           $data=productitems::paginate(3);

           $user=auth()->user();

           $count=cart::where('phone',$user->phone)->count();


           return view('user.home',compact('data','count'));  
       }
   }

   public function index()
   {    
       if(Auth::id())
       {
           return redirect('redirect');
       }
       else
       {
           $data=productitems::paginate(3);
        return view('user.home',compact('data'));  
       }
       
   }
   public function search(Request $request)
   {
       $search=$request->search;

       if($search=='')
       {
        $data=productitems::paginate(3);
        return view('user.home',compact('data')); 
       }

       $data=productitems::where('title','Like','%'.$search.'%')->get();
         
       return view('user.home', compact('data'));
   
    }

    public function addcart(Request $request ,$id)
    {
             if(Auth::id())
             {
                 $user=auth()->user();
                 $productitems=productitems::find($id);
                 $cart=new cart;

                 $cart->name=$user->name;
                 $cart->phone=$user->phone;
                 $cart->address=$user->address;
                 $cart->product_title=$productitems->title;
                 $cart->price=$productitems->price;
                 $cart->quantity=$request->quantity;
                 $cart->save();
             
                 return redirect()->back()->with('message','product updated Successfully');

             }
             else{
                 return redirect('login');
             }
    }

    public function showcart()
    {
 
        $user=auth()->user();

        $cart=cart::where('phone',$user->phone)->get();

        

        $count=cart::where('phone',$user->phone)->count();



        return view('user.showcart',compact('count','cart'));
    }

    public function deletecart($id)
    {
        $data=cart::find($id);
        $data->delete();
        return redirect()->back()->with('message','product deleted Successfully');
    }

    public function confirmorder(Request $request)
    {
        $user=auth()->user();

        $name=$user->name;

        $phone=$user->phone;

        $address=$user->address;

        foreach($request->productitemsname as $key=>$productitemsname)
          
         {
             $order=new order;

             $order->product_name=$request->productitemsname[$key];

             $order->price=$request->price[$key];

             $order->quantity=$request->quantity[$key];


             $order->name=$name;

             $order->phone=$phone;

             $order->address=$address;

             $order->status='not delivered';
          
             $order->save();

            }

            DB::table('carts')->where('phone',$phone)->delete();
  
            return redirect()->back()->with('message','product ordered Successfully');
    }

}
