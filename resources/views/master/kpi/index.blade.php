@extends('layouts.app')
@section('content')
@include('breadcrum',['title'=>$title,'page'=>$page,'page_sub'=>$page_sub])

<div class="container">
    @include('flash-message')
    @include('submit-form',
    [
    'header' => "New KPI",
    'url' => "kpi/add",
    'form_component' => [
    ['ht_type'=>'select','name'=>'department_id','array'=>$department,'array_opt'=>['value'=>'id','opt'=>'department']],
    ['ht_type'=>'input','name'=>'kpi']
    ],
    'data_array' => $kpi,
    'th_array'=> ['kpi','Edit','Disable'],
    'td_array'=> ['kpi','',''],
    ])
</div>
@endsection
