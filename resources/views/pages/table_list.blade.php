@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Client List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">ClientTable</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" style="table-layout:fixed;">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Device OS
                  </th>
                  <th>
                  Location
                  </th>
                  <th>
                    Notification
                  </th>
                </thead>
                <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>
                    {{$client['id']}}
                    </td>
                    <td>
                    {{$client['name']}}
                    </td>
                    <td>
                    {{$client['email']}}
                    </td>
                    <td>
                    {{$client['device']}}
                    </td>
                    <td class="text-primary">
                         <!--$table = explode ("," , $client['location']);-->
                         {{$client['location']}}
                    </td>
                    <td>
                  <a class="btn btn-primary btn-sm" href="{{route('notifications')}}/{{$client['device_id']}}">notifier</a>
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
    <div class="row justify-content-center">
           {{ $clients->links() }}
    </div>
  </div>
</div>
@endsection
