@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<div class="container-fluid">
   <div class="card">
      <div class="card-body">
         <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
               <div class="card-body p-6">
                  <h5 class="card-title fw-semibold mb-4">Clients</h5>
                  <div class="table-responsive">
                     <table class="table text-nowrap mb-0 align-middle" id="table_id">
                        <thead class="text-dark fs-4">
                           <tr>
                              <th class="border-bottom-0">
                                 <h6 class="fw-semibold mb-0">Id</h6>
                              </th>
                              <th class="border-bottom-0">
                                 <h6 class="fw-semibold mb-0">Name</h6>
                              </th>
                              <th class="border-bottom-0">
                                 <h6 class="fw-semibold mb-0">Email</h6>
                              </th>
                              <th class="border-bottom-0">
                                 <h6 class="fw-semibold mb-0">Action</h6>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($clients as  $key=> $client)
                           <tr>
                              <td class="border-bottom-0">
                                 <h6 class="fw-semibold mb-0">{{ $key }}</h6>
                              </td>
                              <td class="border-bottom-0">
                                 <h6 class="fw-semibold mb-1"></h6>
                                 <span class="fw-normal">{{ $client->name }}</span>
                              </td>
                              <td class="border-bottom-0">
                                 <p class="mb-0 fw-normal">{{ $client->email }}</p>
                              </td>
                              <td class="border-bottom-0">
                                 <p class="mb-0 fw-normal">  <a href="{{ route('client.Edit',$client->id) }}" class="btn btn-primary m-1">Edit</a>
                                 </p>
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
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
   $(document).ready(function () {
       $.noConflict();
       $('#table_id').DataTable();
   });
</script>
@endpush
@endsection
