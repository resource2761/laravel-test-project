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
                            Multiple Image Upload
                        </div>

                        <div class="card-group">

                            @foreach($multipic as $images)
                            <div class="col-md-4 mt-3 mb-5">
                                <div class="card">
                                    <img src="{{asset($images->image)}}">
                                </div>  
                            </div>
                            @endforeach
                        </div>
                        {{$multipic->links()}} <!--Apply for pagination and with with source array -->
        
        

                        </div>
                </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Images
                            </div>

                            <div class="card-body">
                            <form action="{{ route('store.multipleimage') }}" method="post" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Multiple Image</label>
                                    <input type="file" name="image[]" multiple="true" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                 
                                </div>
                             
                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </form>
                            </div>
                        </div>
                                

                    </div>
                </div> 

            </div>



        </div>
    </x-app-layout>
