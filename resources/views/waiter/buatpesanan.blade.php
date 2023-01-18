@extends('layouts.dashboard')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
<!-- / Layout wrapper -->
@foreach ($menu as $item)
<p>{{$item->nama}}</p>
    
@endforeach

@endsection
