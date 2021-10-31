@extends('layouts.app')
@section('content')
@include('breadcrum',['title'=>$title,'page'=>$page,'page_sub'=>$page_sub])

<div class="container">

    @include('flash-message')

    @include('submit-form',
    [

    'header' => "New Location",

    'url'    => "department/add",

    'form_component' => [

            ['ht_type'=>'select','name'=>'location_id','array'=>$location,'array_opt'=>['value'=>'id','opt'=>'location']],

            ['ht_type'=>'input','name'=>'department'],
    ],

    'data_array' => $department,

    'th_array'   => ['Location','Department','Edit','Disable'],

    'td_array'   => ['','department','',''],

    ])
</div>

@endsection
