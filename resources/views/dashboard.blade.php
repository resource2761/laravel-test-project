<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <!-- show user name that already logged -->
        Hello, <b>{{Auth::user()->name }}</b>
        <b style="float:right">
        
        Total Users 
        <span class="badge badge-danger">{{count($users)}}</span>
    
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
      @php($i=1) <!-- variable Initialisation -->
      @foreach($users as $usersdata)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$usersdata->name}}</td>
      <td>{{$usersdata->email}}</td>
      <td>{{$usersdata->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</div>
</table>
</div>


    </div>
</x-app-layout>
