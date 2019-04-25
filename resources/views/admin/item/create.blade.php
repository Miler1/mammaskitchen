@extends('layouts.app')

@section('title','Item')

@push('css')
	
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        @include('layouts.partial.msg')
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="title ">Add new Item</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating">
                    <label class="control-label">Category</label>
                    <select class="form-control" name="category">
                      <option>Select a category...</option>
                      @foreach($categories as $category) 
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating">
                    <label class="control-label">Name</label>
                    <input class="form-control" type="text" name="name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating">
                    <label class="control-label">Price</label>
                    <input class="form-control" type="number" name="price">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label class="control-label">Image</label>
                  <input type="file" name="image">
                </div>
              </div>
              <a href="{{ route('item.index') }}" class="btn btn-danger">Back</a>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
	
@endpush