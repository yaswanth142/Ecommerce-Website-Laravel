<x-app-layout>
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
  <head>
      @include('admin.css')
  </head>
  <body>
   
      <!-- partial -->
         @include('admin.slidebar') 
        @include('admin.navbar')
        <!-- partial -->
      
        <div style="padding-bottom:30px;" class="container-fluid page-body-wrapper">

        <div class="container" align="center">
        @if(session()->has('message'))
   <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
                      {{session()->get('message')}}
    </div>
                      @endif

        <table>
            <tr style="background-color:red;">
                <td style="padding:20px">Title</td>
                <td style="padding:20px">Description</td>
                <td style="padding:20px">Quantity</td>
                <td style="padding:20px">Price</td>
                <td style="padding:20px;">Image</td>
                <td style="padding:20px">Update</td>
                <td style="padding:20px">Delete</td>
            </tr>
                 @foreach($data as $productitems)
            <tr  align:"center" style="background-color:black;">
                <td>{{$productitems->title}}</td>
                <td>{{$productitems->description}}</td>
                <td>{{$productitems->quantity}}</td>
                <td>{{$productitems->price}}</td>
                <td>
                    <img height="100px" width="100px" src="/productimage/{{$productitems->image}}">
                </td>

                <td>
                    <a class="btn btn-primary" href="
                    {{url('updateproductitems',$productitems->id)}}">Update</a>
               </td>

               <td>
                    <a class="btn btn-danger" onclick="return
                    conform('Are you sure')"  href="
                    {{url('deleteproductitems',$productitems->id)}}">Delete</a>
               </td>
            </tr>

             @endforeach

        </table>

         </div>
         </div>


          <!-- partial -->
        @include('admin.script')
  </body>
</html>