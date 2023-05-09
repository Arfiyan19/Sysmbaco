@extends('backend.layouts.master')

@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Review Lists</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      @if(count($reviews)>0)
      <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Review By</th>
            <th>Product</th>
            <th>Review</th>
            <th>Rating</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>S.N.</th>
            <th>Review By</th>
            <th>Product Title</th>
            <th>Review</th>
            <th>Rate</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($reviews as $review)
          <tr>
            <td>{{$review->id}}</td>
            <td>{{$review->user_info->name}}</td>
            <td>{{$review->product->title}}</td>
            <td>{{$review->review}}</td>
            <td>
              @for($i=1;$i<=5;$i++) @if($review->rate>=$i) <i class="fas fa-star" style="color:orange"></i> @else <i class="fas fa-star" style="color:gray"></i> @endif @endfor
            </td>
            <td>{{date('d-m-Y',strtotime($review->created_at))}}</td>
            <td>
              @if($review->status=='active')
              <span class="badge badge-success">{{$review->status}}</span>
              @else
              <span class="badge badge-warning">{{$review->status}}</span>
              @endif
            </td>
            <td>
              <a href="{{route('review.edit',$review->id)}}" class="btn btn-primary btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>
              <form method="POST" action="{{route('review.destroy',[$review->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm dltBtn" data-id={{$review->id}} data-toggle="tooltip" title="Delete Data"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h6 class="text-center">No reviews found!!!</h6>
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
  div.dataTables_wrapper div.dataTables_paginate {
    display: none;
  }
</style>
@endpush

@push('scripts')

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
  $('#order-dataTable').DataTable({
    "columnDefs": [{
      "orderable": false,
      "targets": [5, 6]
    }]
  });

  // Sweet alert

  function deleteData(id) {

  }
</script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.dltBtn').click(function(e) {
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      // alert(dataID);
      e.preventDefault();
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          } else {
            swal("Your data is safe!");
          }
        });
    })
  })
</script>
@endpush