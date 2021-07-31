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
                            All Category
                        </div>
        
        
        
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Username</th>
                                <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- @php($i=1) -->
                                @foreach($categories as $categories_data)
                                <tr>
                                <!-- <td>{{$i++}}</td>     -->
                                <!-- FOR index of Sl No 1,2,3,4,5,6,7,8,9,10  -->
                                
                                <td>{{$categories->firstItem()+$loop->index}}</td>
                                <td>{{$categories_data->category_name}}</td>
                                <td>{{$categories_data->user_id}}</td>
                                <td>{{$categories_data->created_at}}</td>
                                <td>{{$categories_data->user_data->name}}</td> 
                                <td><a href="{{url('category/edit/'.$categories_data->id) }}" class="btn btn-info">Edit</a></td> 
                                <td><a href="{{url('category/delete/'.$categories_data->id) }}" class="btn btn-danger">Delete</a></td> 


                                </tr>
                                @endforeach
                            </tbody>
                            </div>
                        </table>
                        {{$categories->links()}} <!--Apply for pagination -->

                        </div>
                </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Category
                            </div>

                            <div class="card-body">
                            <form action="{{ route('store.category') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name">
                                    <!-- Shows Error Message -->
                                    @error('category_name')
                                        <span class="text-danger">{{$message}}</span> 
                                    @enderror
                                </div>
                             
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                            </div>
                        </div>
                                

                    </div>
                </div>

            </div>



            <!-- Trash Section for Softdelete of category -->

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">


                        <div class="card-header">
                            Trash List
                        </div>
        
        
        
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Username</th>
                                <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- @php($i=1) -->
                                @foreach($trashCat as $categories_data)
                                <tr>
                                <!-- <td>{{$i++}}</td>     -->
                                <!-- FOR index of Sl No 1,2,3,4,5,6,7,8,9,10  -->
                                
                                <td>{{$trashCat->firstItem()+$loop->index}}</td>
                                <td>{{$categories_data->category_name}}</td>
                                <td>{{$categories_data->user_id}}</td>
                                <td>{{$categories_data->created_at}}</td>
                                <td>{{$categories_data->user_data->name}}</td> 
                                <td><a href="{{url('category/restore/'.$categories_data->id) }}" class="btn btn-info">Restore</a></td> 
                                <td><a href="{{url('category/Confirm_Delete/'.$categories_data->id) }}" class="btn btn-danger">Delete</a></td> 


                                </tr>
                                @endforeach
                            </tbody>
                            </div>
                        </table>
                        {{$trashCat->links()}} <!--Apply for pagination -->

                        </div>
                </div>


                    <div class="col-md-4">
                     
                                

                    </div>
                </div>

            </div>

            <!--  TrashSection End of Softdelete of Category -->



        </div>
    </x-app-layout>
