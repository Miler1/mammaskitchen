@extends('layouts.app')

@section('title','Reservation')

@push('css')
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- <a href="{{ route('item.create') }}" class="btn btn-primary">Add New</a> -->
          @include('layouts.partial.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">All Items</h4>
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
                      Name
                    </th>
                    <th>
                      Phone
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Time and Date
                    </th>
                    <th>
                      Message
                    </th>
                    <th>
                      Status
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
                   	 @foreach($reservations as $key=>$reservation)
                   	 	<tr>
                   	 		<td>{{ $key + 1 }}</td>
                   	 		<td>{{ $reservation->name }}</td>
                   	 		<td>{{ $reservation->phone}}</td>
                   	 		<td>{{ $reservation->email }}</td>
                        <td>{{ $reservation->date_and_time }}</td>
                        <td>{{ $reservation->message }}</td>
                        <th>
                          @if($reservation->status == true)
                            <span class="badge badge-info">Confirmed</span>
                          @else
                            <span class="badge badge-danger">not Confirmed yet</span>
                          @endif
                        </th>
                   	 		<td>{{ $reservation->created_at }}</td>
                   	 		<td>{{ $reservation->updated_at }}</td>
                        <td><!-- <a href="" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a> -->
                          @if($reservation->status == false)
                            <form id="status-form-{{ $reservation->id }}" action="{{ route('reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                              @csrf
                            </form>
                              <!-- <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you verify this request by phone?')) {
                                event.preventDefault();
                                document.getElementById('status-form-{{ $reservation->id }}').submit(); 
                              } else {
                                event.preventDefault(); 
                              }"> -->
                              <button type="button" class="btn btn-info btn-sm" onclick="
                              Swal.fire({
                                  title: 'Are you sure?',
                                  text: 'Are you verify this request by phone?',
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Yes',
                                }).then((result) => {
                                if (result.value) {
                                  document.getElementById('status-form-{{ $reservation->id }}').submit();
                                  Swal.fire(
                                    'Confirmed!',
                                    'Your Status are Updated.',
                                    'success'
                                  )
                                }
                              })">
                              <i class="material-icons">done</i></button>
                          @endif
                          <form id="delete-form-{{ $reservation->id }}" action="{{ route('reservation.destroy',$reservation->id) }}" style="display: none;" method="POST">
                              @csrf
                              @method('DELETE')
                            </form>
                              <!-- <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want delete this?')) {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $reservation->id }}').submit(); 
                              } else {
                                event.preventDefault(); 
                              }"> -->
                              <button type="button" class="btn btn-danger btn-sm" onclick="
                              Swal.fire({
                                  title: 'Are you sure?',
                                  text: 'Are you sure? You want delete this?',
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Yes',
                                }).then((result) => {
                                if (result.value) {
                                  document.getElementById('delete-form-{{ $reservation->id }}').submit();
                                  Swal.fire(
                                    'Deleted!',
                                    'Your row has been deleted.',
                                    'success'
                                  )
                                }
                              })">
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