@extends('layouts.admin.master')
@section('content')

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="alert alert-primary" role="alert">
            Welcome {{ Auth::user()->name }}
          </div>
      </div>
    </div>
</div>

@endsection
