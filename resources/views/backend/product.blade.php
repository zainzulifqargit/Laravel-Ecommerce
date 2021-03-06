
@extends('backend.layouts.app')
@section('content')

     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Product</h1>

        
      </div>


      <div class="col-md-12">
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
        <a href="{{route('admin.product.create')}}" class="btn btn-primary">Add Product</a>
         <a href="{{route('admin.product.trash')}}" class="btn btn-primary">View Trash</a>
         </div>
         </div>
        @if(Session('message'))
        <div class="alert alert-success">
          {{session('message')}}
        </div>
        @endif
       <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
          </ol>
        </nav>
      </div>
      

     
     <div class="col-md-12">
      <div class="table table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>

              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Slug</th>
             
              <th>Categories</th>
              <th>Thumbnail</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @if($data)
            @foreach($data as $s)
            <tr>
              <td>{{$s->id}}</td>
              <td>{{$s->title}}</td>
              <td>{!!$s->description!!}</td>
              <td>{{url('/')}}/{{$s->slug}}</td>
              <td>
                @if($s->category->count() > 0)
                  @foreach($s->category as $children)
                    {{$children->name}},
                    @endforeach
                    
                @else
                  <strong>{{'Parent Category'}}</strong>
                @endif
              </td>
              
                <td><img width="40px;" height="40px" src="{{asset('public/images/'.$s->thumbnail)}}"></td>
                <td><a class="btn btn-info btn-sm" href="{{route('admin.product.edit',$s->slug)}}">Edit</a> | <a class="btn btn-warning btn-sm" href="{{route('admin.product.putIntoTrash',$s->slug)}}">Trash</a> | <a class="btn btn-danger btn-sm" href="javascript:" onclick="confrimDelete('{{$s->id}}')">Delete</a>
                   <form id="category-form-{{$s->id}}" action="{{ route('admin.product.destroy',$s->slug) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                      
                                         
            </tr>
            @endforeach
            @else
            {{'No data Found'}}
            @endif

          </tbody>
        </table>
        {{$data->links()}}
      </div>
    </div>
    </main>
  </div>
</div>
@endsection()

@section('scripts')
  <script>
     function confrimDelete(id){
      let choice = confirm('Are u sure,u want to delete this');
      if(choice)
      {


      document.getElementById('category-form-'+id).submit();
    }
     }
  </script>
@endsection()
