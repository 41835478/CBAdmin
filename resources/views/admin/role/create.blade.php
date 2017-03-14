@extends('adminlte::page')

@section('title', $title)

@section('content_header')

    <h3>{{ $title }}</h3>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i>首页</a></li>
        <li><a href="{{ url('admin/role/index') }}">角色列表</a></li>
        <li class="active">{{ $title }}</li>
    </ol>

@stop

@section('content')
        <div class="box box-primary">
            <div class="box-header with-border">
               <div class="box-title">{{ $title }}
               </div>
            </div>

            <div class="box-body">
                @include('admin.message')
                @include('admin.validator')
                @include('admin.role.form')
            </div>
        </div>
@stop
