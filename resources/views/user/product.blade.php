<div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
           
           <form class="form-inline" action="{{url('search')}}" method="get" style="float:right;padding:10px">
           @csrf    
           <input  style="color:black" class="form-control" type="search" 
               name="search" placeholder="search">

               <input  style="color:black" type="submit" value="Search" class="btn btn-success">
          </form>           
            </div>
          </div>
          
          @foreach($data as $productitems)

          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img height="200" width="100" src="/productimage/{{$productitems->image}}" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>{{$productitems->title}}</h4></a>
                <h6>${{$productitems->price}}</h6>
                <p>${{$productitems->description}}</p>
   
                <form action="{{url('addcart',$productitems->id)}}" method="POST">
                    @csrf

<input type="number" value="" min="1" 
class="form-control" style="width:100px" name="quantity">
<br>
                    <input style="color:black" class="btn btn-primary" type="submit"
                    value="Add Cart">
                </form>
               
              </div>
            </div>
          </div>

          @endforeach

          @if(method_exists($data,'links'))

          <div class="d-flex justify-content-center">

          {!! $data->links() !!}

          </div>

          @endif


        </div>
      </div>
    </div>
