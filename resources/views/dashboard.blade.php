@extends('layouts.app',['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">stay_current_portrait</i>
              </div>
              <p class="card-category">Total device </p>
              <h3 class="card-title" id="totalDevice">
                {{$totalDevice}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">android</i>
              </div>
              <p class="card-category">android</p>
              <h3 class="card-title" id="totalAndroid">{{$totalAndroid}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">chat_bubble</i>
              </div>
              <p class="card-category">Total Notification</p>
              <h3 class="card-title" id="totalNotification">
              {{$totalNotification}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-apple"></i>
              </div>
              <p class="card-category">ios</p>
              <h3 class="card-title" id="totalIos">{{$totalIos}}</h3>
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
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Users Sessions</h4>
              <p class="card-category">
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last Week
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Users Inscriptions</h4>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i> Last Year
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Read Notifications</h4>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i> Last Year
              </div>
            </div>
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
      md.initDashboardPageCharts();
      // $.get('/api/data/charts',function(data){
      //   console.log(data);
      // });
    });
  </script>
@endpush
