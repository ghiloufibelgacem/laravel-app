@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('Notifications')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7">
      <div class="card card-plain">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <form class="form" id="target" method="POST" action="{{ route('notifications')}}">
                @csrf
                <!-- card-login card-hidden  -->
                <div class="card mb-2">
                  <!-- card-header-primary -->
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">
                      <strong>{{ __('Create new Push Notification') }}</strong>
                    </h4>
                  </div>
                  <div class="card-body">
                    <div class="bmd-form-group col-md-11">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">loyalty</i>
                          </span>
                        </div>
                        <input type="text" name="title" class="form-control" placeholder="{{ __('Title') }}" required>
                      </div>
                    </div>
                    <div class="bmd-form-group mt-3 col-md-11">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">chat_bubble</i>
                          </span>
                        </div>
                        <textarea  rows="4" name="content" class="form-control" placeholder="{{ __('Message') }}" required></textarea>
                      </div>
                    </div>
                    <div class="row justify-content-center" >
                      <!-- col-md-6 col-sm-10 col-10 -->
                      <!-- <div  class="btn-group" id="showMap" data-toggle="buttons">
                          <label class="btn btn-primary btn-sm">
                            <input type="radio" name="platform" id="android" value="android"/>
                            <i class="material-icons">android</i>
                          </label>
                          <label class="btn btn-primary  btn-sm">
                              <input type="radio" name="platform" id="ios" value="ios"/>
                              <i class="fa fa-apple"></i>
                          </label>
                          <label class="btn btn-primary btn-sm">
                              <input type="radio" name="platform" id="both" value="both" checked/>
                              <i class="material-icons">stay_current_portrait</i>
                          </label>
                           <label class="btn btn-primary btn-sm" id="allLabel">
                              <input type="radio" name="platform" id="all" value="all"/>
                              <i class="material-icons">supervisor_account</i>
                          </label>
                      </div> -->
                      <label class="btn btn-primary btn-sm x">
                        <input type="radio" name="platform" id="android" value="android"/>
                        <i class="material-icons">android</i>
                      </label>
                      <label class="btn btn-primary btn-sm x">
                          <input type="radio" name="platform" id="ios" value="ios"/>
                          <i class="fa fa-apple"></i>
                      </label>
                      <label class="btn btn-primary btn-sm x">
                          <input type="radio" name="platform" id="both" value="both" checked/>
                          <i class="material-icons">stay_current_portrait</i>
                      </label>
                      <label class="btn btn-primary btn-sm" id="allLabel">
                         <input type="radio" name="platform" id="all" value="all"/>
                         <i class="material-icons">supervisor_account</i>
                     </label>

                      @if(isset($clientKey))
                      <input id="clientKey" name="clientKey"  type="hidden" value="{{$clientKey}}">
                      @else
                      <input id="clientKey" name="clientKey"  type="hidden" value="">
                      @endif
                      <input id="lat" name="latitude"  type="hidden" value="36.862499">
                      <input id="lng" name="longitude" type="hidden" value="10.195556">
                    </div>
                  </div>
                  <div class="card-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Push') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- map -->
          <div id ="map">
          </div>
        </div>
      </div>
    </div>
    <!-- phone image -->
    <div class="col-md-5">
      <div class="card card-plain">
        <div class="card-header text-center">
          <label id="labelForAndroid" class="btn btn-primary btn-sm">
            <i class="material-icons">android</i>
          </label>
          <label id="labelForIos" class="btn btn-primary btn-sm">
            <i class="fa fa-apple"></i>
          </label>
        </div>
        <div class="card-body viewAndroid" id="viewAndroid">
            <div class="row">
              <h5 class="col-md-4" id="title">Title</h5>
            </div>
            <div class="row">
                <p class="col-md-4" id="content">Message</p>
            </div>
          <div style="position: absolute;bottom:-20px;text-align: center;">
            <p>
              <strong>NOTE: this is a simple preview, It may not correspond exactly to reality</strong>
            </p>
          </div>
        </div>
          <div class="card-body viewIos" id="viewIos">
              <div class="row">
                <h5 class="col-md-7" id="titleIos">GEO PUSH NOTIFICATION</h5>
              </div>
              <div class="row">
                  <p class="col-md-4" id="messageIos">Message</p>
              </div>
          <div style="position: absolute;bottom:-20px;text-align: center;">
            <p>
              <strong>NOTE: this is a simple preview, It may not correspond exactly to reality</strong>
            </p>
          </div>
          </div>
        </div>
      <!-- </div> -->
    </div>
  </div>
  </div>
<!-- </div> -->
<!-- show notification  -->
@if(session()->has('statusNotification'))
<input type="hidden" id="status" name= "notification" value="{{session()->get('statusNotification')}}"/>
@endif
</div>
@endsection
@push('js')
<script>
  $(document).ready(function() {

    // Javascript method's body can be found in assets/js/demos.js
    demo.initGoogleMaps();

    // Listen the keyup event and update notification view
    $("input[name='title']").on('input',function(e){
     $("h5[id='title']").html($(this).val());
    });

    // for message content
    $("textarea[name='content']").on('input',function(e){
    $("p[id='content']").html($(this).val());
    $('p[id="messageIos"]').html($(this).val());
    });

    // submit form;
    $('button[type="submit"]').click(function(event){
      event.preventDefault();
      let form =$('form[id="target"]');
      if(form.valid())
      {
        //console.log('form submited successfuly');
        form.submit();
      }
    });

  // show notification if exist
    let value = $('input[id="status"]').val();
  // console.log(input);
    if(value)
    {
      md.showNotification('top','left',value);
    }

  //set preview
    let ios =$('div[id="viewIos"]');
    let android =$('div[id="viewAndroid"]');
    $('label[id="labelForAndroid"]').click(function(event){

      $(ios).hide();
      $(android).show();

    });

    $('label[id="labelForIos"]').click(function(event){
      
      $(android).hide();
      $(ios).show();
     
    });


    // show hide map
    let map = $('#map');
     $('label[class="btn btn-primary btn-sm x"]').click(function(event){
      $(map).show();
     });

     $('#allLabel').click(function(event){
      $(map).hide();
     });

  });
</script>
@endpush
