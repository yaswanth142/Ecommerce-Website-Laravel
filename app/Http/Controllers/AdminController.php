<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\productitems;

use App\Models\Order;

class AdminController extends Controller
{
    public function product()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype=='1')
            {
            return view('admin.product');
            }

            else{
                return redirect()->back();
            }
        }

        else
        {
            return redirect('login');
        }
       
    }

    public function uploadproduct(Request $request)
    {
        $data=new productitems;
        $image=$request->file;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->file->move('productimage',$imagename);
        $data->image=$imagename;

        $data->title=$request->title;

        $data->price=$request->price;

        $data->description=$request->description;

        $data->quantity=$request->quantity;

        $data->save();
        return redirect()->back()->with('message','product Added Successfully');
    }


    public function showproduct()
    {
        $data=productitems::all();
        return view('admin.showproduct',compact('data'));
    }

    public function deleteproductitems($id)

    {
        $data=productitems::find($id);
        $data->delete();
        return redirect()->back()->with('message','product deleted Successfully');
    }

    public function updateproductitems($id)
    {
        $data=productitems::find($id);
        return view('admin.updateproductitems',compact('data'));
    }

    public function updateproduct(Request $request,$id)
    {
        $data=productitems::find($id);

        $image=$request->file;

        if($image)

        {
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->file->move('productimage',$imagename);
        $data->image=$imagename;
        }

        $data->title=$request->title;

        $data->price=$request->price;

        $data->description=$request->description;

        $data->quantity=$request->quantity;

        $data->save();
        return redirect()->back()->with('message','product updated Successfully');
       
    }

    public function showorder()
    {
        $order=order::all();
        return view('admin.showorder',compact('order'));
    }


    public function updatestatus($id)
    {
        $order=order::find($id);

        $order->status='Delivered';

        $order->save();

        return redirect()->back();
    }
}
