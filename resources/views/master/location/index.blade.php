@extends('layouts.app')
@section('content')
@include('breadcrum',['title'=>$title,'page'=>$page,'page_sub'=>$page_sub])

<div class="container">
    @include('flash-message')
    @include('submit-form',
    [
    'header' => "New Location",
    'url' => "location/add",
    'model' => 'Location',
    'form_component' => [
    ['ht_type'=>'input','name'=>'location']
    ],
    'data_array' => $location,
    'th_array'=> ['Location'],
    'td_array'=> ['location'],
    ])
</div>
@endsection
