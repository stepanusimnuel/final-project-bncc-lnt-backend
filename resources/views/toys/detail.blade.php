@extends('partials.main')

@section('container')
<div class="d-md-flex col-md-12 justify-content-center">
    <div class="{{ $isDark ? 'text-bg-dark' : 'bg-body-tertiary' }} me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden col-md-4">
        <div class="my-3 py-5">
            <span class="display-5 d-block text-decoration-none">{{$toy->name}}</span>
            <a class="text-decoration-none text-info" href="/admin/toys/?category={{$toy->category->id}}">{{$toy->category->name}}</a>
        </div>
        <div class="{{ $isDark ? 'bg-body-tertiary' : 'text-bg-dark' }} shadow-sm mx-auto d-flex align-items-center justify-content-center" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
            @if ($toy->image)
                <img src="{{ asset('storage/' . $toy->image) }}" alt="" class="w-100">
            @else
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNeja4RPsl0a6veepaqlXzqvkaOK-jwsJmOQ&s" alt="" class="w-100">
            @endif
        </div>
    </div>

    <div class="d-flex align-items-center col-md-6">
        <div class="p-5">
            <h2>Detail Product</h2>
            <p>{{$toy->description}}</p>
            <small class="text-warning">sisa {{$toy->stock}} barang lagi</small>
            <p class="text-success fw-2 fs-4">Rp{{$toy->price}}</p>

            @auth
                @if (auth()->user()->role != 'admin')
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-beli-sekarang">
                        Beli Sekarang
                    </button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-tambah-keranjang">+ Keranjang</button>

                </div>
                @else
                <small class="text-muted">Anda adalah admin</small>
                @endif
            @else
                <small class="text-danger">Silakan login terlebih dahulu untuk membeli</small>
            @endauth
        </div>
    </div>
</div>



{{-- modal beli sekarang --}}
<form action="/checkout/toys/{{$toy->id}}" method="post">
@csrf
<div class="modal fade" id="modal-beli-sekarang" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex gap-5">
                <div>
                @if ($toy->image)
                    <img src="{{asset('storage/' . $toy->image)}}" alt="" class="w-100">
                @else
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNeja4RPsl0a6veepaqlXzqvkaOK-jwsJmOQ&s" alt="" class="w-100">
                </div>
                @endif

                <div class="mt-3">
                    <p>Rp{{$toy->price}}</p>
                    <p>Stock: {{$toy->stock}}</p>
                    <div class="d-flex gap-2 align-items-center">
                        <span>Jumlah: </span>
                        <input type="number" name="quantity" value="1" class="w-50 @error('quantity')
                            is-invalid
                        @enderror" value="{{old('quantity')}}">

                        @error('quantity')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Beli</button>
        </div>
      </div>
    </div>
  </div>
</form>

{{-- modal tambah sekarang --}}
<form action="/cart/toys/{{$toy->id}}" method="post">
    @csrf
    <div class="modal fade" id="modal-tambah-keranjang" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-5">
                    <div>
                    @if ($toy->image)
                        <img src="{{asset('storage/' . $toy->image)}}" alt="" class="w-100">
                    @else
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNeja4RPsl0a6veepaqlXzqvkaOK-jwsJmOQ&s" alt="" class="w-100">
                    </div>
                    @endif

                    <div class="mt-3">
                        <p>Rp{{$toy->price}}</p>
                        <p>Stock: {{$toy->stock}}</p>
                        <div class="d-flex gap-2 align-items-center">
                            <span>Jumlah: </span>
                            <input type="number" name="quantity" value="1" class="w-50 @error('quantity')
                                is-invalid
                            @enderror" value="{{old('quantity')}}">

                            @error('quantity')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </form>
@endsection
