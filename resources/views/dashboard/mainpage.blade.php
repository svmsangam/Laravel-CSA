@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 dashboard-menu">
            <ul>
                <li><strong><a class="text-muted" href="{{route('admin.dashboard.posts')}}">Pending Posts</a></strong></li>
                <li><strong><a class="text-muted" href="{{route('admin.dashboard.comments')}}">Reported Comments</a></strong></li>
            </ul>
        </div>
        <div class="offset-md-2 col-md-8 dashboard-content">
        @yield('dashboard-content')
        </div>
    </div>
</div>
@endsection 