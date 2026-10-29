@extends('layouts.app')
 
@section('title', 'VESTI')
 
@section('content')
<div class="hero" id="hero"></div>
<div class="brands" id="brands"></div>
<div id="main"></div>
<div id="pg" style="display:none"></div>
@endsection
 
@push('data')
<script>
window.VESTI = @json(['brands' => $brands, 'items' => $items]);
</script>
@endpush
 