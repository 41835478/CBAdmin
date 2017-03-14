@extends('adminlte::page')
@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/plugins/iCheck/all.css')}} ">
@stop

@section('title', '编辑菜单')

@section('content_header')
    <div class="row">
        <div class="col-sm-12">
            <h3>编辑菜单</h3>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i>首页</a></li>
                <li><a href="{{ url('admin/menu/index') }}">菜单管理</a></li>
                <li class="active">编辑菜单</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">编辑菜单</div>
            </div>
            <div class="box-body">
                @include('admin.message')
                @include('admin.validator')
                @include('admin.menu.form')
            </div>
        </div>
@stop
@section('js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function(){
            $('input[type="radio"].minimal').iCheck({
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
@endsection