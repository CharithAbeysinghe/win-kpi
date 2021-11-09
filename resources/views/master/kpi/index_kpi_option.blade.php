@extends('layouts.app')
@section('content')
@include('breadcrum',['title'=>$title,'page'=>$page,'page_sub'=>$page_sub])

<div class="container">
    @include('flash-message')
    @include('submit-form',
    [
    'header' => "KPI",
    'url' => "kpi/add-option",
    'form_component' => [
    ['ht_type'=>'select','name'=>'kpi_id','array'=>$kpi,'array_opt'=>['value'=>'id','opt'=>'kpi']],
    ['ht_type'=>'input','name'=>'kpi_option']
    ],
    'data_array' => $kpiOption,
    'th_array'=> ['kpi','kpi option','Disable'],
    'td_array'=> ['get_kpi()->kpi','kpi_option',''],
    ])
</div>
@endsection
