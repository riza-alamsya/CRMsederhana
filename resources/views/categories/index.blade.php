@extends('layouts.index')

@section('konten')
<div class="row">
    

  @if(session('status'))
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning">
          {{session('status')}}
        </div>
      </div>
    </div>
  @endif 

  <div class="row">
    <div class="col-md-12 text-right">
      <a href="{{route('categories.create')}}" class="btn btn-primary">Create category</a>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-stripped">
        <thead>
          <tr>
            <th><b>Name</b></th>
            <th><b>Image</b></th>
            <th><b>Actions</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td>{{$category->name}}</td>
              <td>
                @if($category->image)
                  <img src="{{asset('storage/' . $category->image)}}" width="48px"/>
                @else 
                  No image
                @endif
              </td>
              <td>
                <a 
                  href="{{route('categories.edit', [$category->id])}}"
                  class="btn btn-info btn-sm"> Edit </a>

               
                <form 
                  class="d-inline"
                  action="{{route('categories.destroy', [$category->id])}}"
                  method="POST"
                  onsubmit="return confirm('Move category to trash?')"
                  >

                  @csrf 

                  <input 
                    type="hidden" 
                    value="DELETE" 
                    name="_method">

                  <input 
                    type="submit" 
                    class="btn btn-danger btn-sm" 
                    value="Delete">

                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colSpan="10">
              {{$categories->appends(Request::all())->links()}}
            </td>
          </tr>
        </tfoot>

      </table>
    </div>
  </div>  
@endsection