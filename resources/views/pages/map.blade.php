@extends('layouts.app', ['activePage' => 'map', 'titlePage' => __('Map')])
@section('content')
 <div class="content"> 
 <div class="container-fluid">
  <div class="row justify-content-center">
    <div class="card col-md-10 card-plain">
      <div class="card-body">
        <div id="map"></div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@push('js')
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initGoogleMaps();
  });
</script>
@endpush
