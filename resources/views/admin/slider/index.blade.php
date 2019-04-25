@extends('layouts.app')

@section('title','Slider')

@push('css')
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="{{ route('slider.create') }}" class="btn btn-primary">Add New</a>
          @include('layouts.partial.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">All Slider</h4>
              <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead class=" text-primary">
                    <th>
                      ID
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Sub Title
                    </th>
                    <th>
                      Image
                    </th>
                    <th>
                      Created At
                    </th>
                    <th>
                      Updated At
                    </th>
                    <th>
                      Action
                    </th>
                  </thead>
                  <tbody>
                   	 @foreach($sliders as $key=>$slider)
                   	 	<tr>
                   	 		<td>{{ $key + 1 }}</td>
                   	 		<td>{{ $slider->title }}</td>
                   	 		<td>{{ $slider->sub_title }}</td>
                   	 		<td>{{ $slider->image }}</td>
                   	 		<td>{{ $slider->created_at }}</td>
                   	 		<td>{{ $slider->updated_at }}</td>
                        <td><a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                            <form id="delete-form-{{ $slider->id }}" action="{{ route('slider.destroy', $slider->id) }}" style="display: none;" method="POST">
                              @csrf
                              @method('DELETE')
                            </form>
                              <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want delete this?')) {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $slider->id }}').submit(); 
                              } else {
                                event.preventDefault(); 
                              }">
                              <!-- <button type="button" class="btn btn-danger btn-sm" onclick="
                              Swal.fire({
                                  title: 'Are you sure?',
                                  text: 'You want delete this?',
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Yes',
                                }).then((result) => {
                                if (result.value) {
                                  document.getElementById('delete-form-{{ $slider->id }}').submit();
                                  Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                  )
                                }
                              })"> -->
                              <i class="material-icons">delete</i></button>
                        </td>
                   	 	</tr>
                   	 @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table').DataTable();
		});
	</script>
@endpush