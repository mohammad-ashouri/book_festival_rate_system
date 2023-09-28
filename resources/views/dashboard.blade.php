@extends('layouts.PanelMaster')

@section('content')
    @php
        $userInfo=\App\Models\User::find(session('id'));
    @endphp
    @if($userInfo->type==1)
        @include('Panels.Dashboards.SuperAdmin')
    @elseif($userInfo->type==2)
        @include('Panels.Dashboards.Admin')
    @elseif($userInfo->type==3)
        @include('Panels.Dashboards.Header')
    @elseif($userInfo->type==4)
        @include('Panels.Dashboards.Rater')
    @elseif($userInfo->type==5)
        @include('Panels.Dashboards.ClassificationExpert')
    @endif
@endsection

