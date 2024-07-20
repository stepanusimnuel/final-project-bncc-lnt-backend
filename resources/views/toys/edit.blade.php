@extends('partials.main')

@section('container')
<h2 class="text-center mt-5">Form Edit</h2>
<div class="d-flex justify-content-center mt-2">
    <div class="col-md-6 mb-5">
        <form action="/admin/toys/{{$toy->id}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Mainan</label>
                <input type="text" name="name" class="form-control @error('name')
                    is-invalid
                @enderror" autofocus value="{{old('name', $toy->name)}}" id="name" >

                @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select" id="category_id" name="category_id" >
                    @foreach ($categories as $category)
                        @if (old('category_id', $toy->category_id) == $category->id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" class="form-control @error('stock')
                    is-invalid
                @enderror" value="{{old('stock', $toy->stock)}}" id="stock" name="stock" >

                @error('stock')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control @error('price')
                    is-invalid
                @enderror" value="{{old('price', $toy->price)}}" id="price" name="price">

                @error('price')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label @error('image')
                    is-invalid
                @enderror">Gambar Mainan</label>

                <input type="hidden" name="oldImage" value="{{$toy->image}}">

                @if ($toy->image)
                    <img src="{{asset('storage/' . $toy->image)}}" alt="{{$toy->name}}" class="d-block">
                @endif

                <input class="form-control" type="file" id="image" name="image">

                @error('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Mainan</label>
                <textarea name="description" type="text" class="form-control" id="description" name="description">{{old('description', $toy->description)}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update mainan</button>
        </form>
    </div>
</div>
@endsection
