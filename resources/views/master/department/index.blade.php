@extends('layouts.app')
@section('content')
@include('breadcrum',['title'=>$title,'page'=>$page,'page_sub'=>$page_sub])

<div class="container">

    @include('flash-message')

    @include('submit-form',
    [

    'header' => "New Department",

    'url'    => "department/add",

    'model' => 'Department',

    'form_component' => [

            ['ht_type'=>'input','name'=>'department'],
    ],

    'data_array' => $department,

    'th_array'   => ['Department'],

    'td_array'   => ['department'],

    ])
</div>

@endsection
