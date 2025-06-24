@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>
                <div class="card">
                    <form action="{{ route('category.update',$category->id) }}" method="post">
                        @csrf
                        @method ('PUT')
                        <div class="mb-2">
                            <label for="">Nama Kategori</label>
                            <input type="text" name="name" value="{{ $category->name }}" 
                                class="form-control" @error('name') is-invalid @enderror></input>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Simpan</button>
                            <button type="reset" class="btn btn-sm btn-outline-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection