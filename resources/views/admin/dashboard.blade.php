@extends('layouts.app')

@section('title', 'Dashboard')

@push('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_copy</i>
            </div>
            <p class="card-category">Category / Item</p>
            <h3 class="card-title">{{ $categoryCount }}/{{ $itemCount }}
              <!-- <small>GB</small> -->
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">info</i>
              <a href="#pablo">Total Categories and Items</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">slideshow</i>
            </div>
            <p class="card-category">Slider Count</p>
            <h3 class="card-title">{{ $sliderCount }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> <a href="{{ route('slider.index') }}">Get More Details...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">info_outline</i>
            </div>
            <p class="card-category">Reservation</p>
            <h3 class="card-title">{{ $reservations->count() }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">local_offer</i> Not Confirmed Reservation
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="fa fa-twitter"></i>
            </div>
            <p class="card-category">Contact</p>
            <h3 class="card-title">{{ $contactCount }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i> Just Updated
            </div>
          </div>
        </div>
      </div>
    </div>
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
                      Status
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
                        <th>
                          @if($reservation->status == true)
                            <span class="badge badge-info">Confirmed</span>
                          @else
                            <span class="badge badge-danger">not Confirmed yet</span>
                          @endif
                        </th>
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