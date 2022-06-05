@extends('layouts.index')

@section('konten')
<h2>Tambah Kategori</h2> 


<form method="post"  action="{{route('categories.store')}}"  enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label>Kategori</label>
		<input type="text" class="form-control" name="name" required>
		</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="image" required>
		</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>

@endsection