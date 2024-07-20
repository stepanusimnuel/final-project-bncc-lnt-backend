@extends('partials.main')

@section('container')
    @include('partials.hero')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-md-12 bg-secondary d-flex justify-content-center my-3">
        <div class="col-md-9 py-5">
            <a href="/" class="btn bg-light px-4 py-2 rounded mb-2">Semua</a>
            @foreach ($categories as $category)
                <a href="/?category={{$category->id}}" class="btn bg-light px-4 py-2 rounded mb-2">{{$category->name}}</a>
            @endforeach
        </div>
    </div>

    <h2 class="text-center fs-1 text-bg-dark p-4">{{$titleProducts}}</h2>

    <div class="d-flex justify-content-center mt-5">
        <div class="col-md-6">
            <form action="/">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{request('category')}}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="cari nama/deskripsi mainanmu disini...">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($toys->count() > 0)

    <div class="col-lg-10 d-md-flex w-100 flex-wrap justify-content-center">
    @foreach ($toys as $toy)
        <div class="{{($loop->iteration - 1) % 6 == 0 || ($loop->iteration - 1) % 6 == 3 || ($loop->iteration - 1) % 6 == 4 ? 'text-bg-dark' : 'bg-body-tertiary'}}
            me-md-3 mt-2 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden col-lg-5">
            <div class="my-3 py-5">
                <a class="display-5 d-block text-decoration-none" href="/toys/{{$toy->id}}">{{$toy->name}}</a>
                <a class="text-decoration-none text-info" href="/?category={{$toy->category->id}}">{{$toy->category->name}}</a>
            </div>

            <div class="{{($loop->iteration - 1) % 6 == 0 || ($loop->iteration - 1) % 6 == 3 || ($loop->iteration - 1) % 6 == 4 ? 'bg-body-tertiary' : 'text-bg-dark'}} mt-2 overflow-hidden shadow-sm mx-auto d-flex align-items-center justify-content-center" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                @if ($toy->image)
                    <img src="{{asset('storage/' . $toy->image)}}" alt="" class="w-100">
                @else
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNeja4RPsl0a6veepaqlXzqvkaOK-jwsJmOQ&s" alt="" class="w-100">
                @endif
            </div>
        </div>
    @endforeach

    </div>
    </div>
    @else
        <h2 class="text-center my-5">Oops.. Mainanmu tidak ditemukan</h2>
    @endif

    @include('partials.footer')
@endsection
