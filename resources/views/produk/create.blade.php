@extends('layouts.index')

@section('konten')
<div class="row">
    <div class="col-md-8">
      <form 
        action="{{route('produk.store')}}"
        method="POST"
        enctype="multipart/form-data"
        class="shadow-sm p-3 bg-white"
        >

        @csrf

        <label for="title">nama</label> <br>
        <input type="text" class="form-control" name="title" placeholder=" nama produk ">
        <br>

        <label for="cover">foto</label>
        <input type="file" class="form-control" name="foto">
        <br>

        <label for="cover">kategori</label>
        <select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			@foreach ($categories as $item)
                
			<option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
		</select>
        <br>

        <label for="description">Description</label><br>
        <textarea name="description" id="description" class="form-control" placeholder="masukan deskripsi"></textarea>
        <br>

        <label for="stock">Stock</label><br>
        <input type="number" class="form-control" id="stock" name="stock" min=0 value=0>
        <br>

      

        

        <label for="Price">Harga </label> <br>
        <input type="number" class="form-control" name="price" id="price" placeholder="Produk harga">
        <br>

        <button 
          class="btn btn-primary" 
          name="save_action" 
          value="PUBLISH">simpan</button>

    
      </form>
    </div>
  </div>
@endsection