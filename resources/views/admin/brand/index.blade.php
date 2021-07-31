<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <!-- show user name that already logged -->
        
        <b style="float:right">
        
        
        <span class="badge badge-danger"></span>
    
        </b>
        </h2>
    </x-slot>

        <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                        <!--  (session('Success')) comes from CategoryController.php  -->
                        @if(session('Success')) 
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('Success')}}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif




                        <div class="card-header">
                            All Brands
                        </div>
        
        
        
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- @php($i=1) -->
                                @foreach($brands as $brands_data)
                                <tr>
                                <!-- <td>{{$i++}}</td>     -->
                                <!-- FOR index of Sl No 1,2,3,4,5,6,7,8,9,10  -->
                                
                                <td>{{$brands->firstItem()+$loop->index}}</td>
                                <td>{{$brands_data->brand_name}}</td>
                                <td><img src="{{asset($brands_data->brand_image)}}" style="height:40px; width:40px;"></td>
                                <td>{{$brands_data->created_at}}</td>
                                <td><a href="{{url('brand/edit/'.$brands_data->id) }}" class="btn btn-info">Edit</a></td> 
                                <td><a href="{{url('brand/delete/'.$brands_data->id) }}" onclick="return confirm('Sure To Delete')" class="btn btn-danger">Delete</a></td> 


                                </tr>
                                @endforeach
                            </tbody>
                            </div>
                        </table>
                        {{$brands->links()}} <!--Apply for pagination -->

                        </div>
                </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Brand
                            </div>

                            <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Brand  Name">
                                    <!-- Shows Error Message -->
                                    @error('brand_name')
                                        <span class="text-danger">{{$message}}</span> 
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Brand Image">
                                    <!-- Shows Error Message -->
                                    @error('brand_image')
                                        <span class="text-danger">{{$message}}</span> 
                                    @enderror
                                </div>
                             
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                            </div>
                        </div>
                                

                    </div>
                </div>

            </div>



        </div>
    </x-app-layout>
