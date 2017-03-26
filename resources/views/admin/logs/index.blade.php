@extends('adminlte::page')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/bootstrap-treeview-1.2.0/css/bootstrap-treeview.css')}} ">
@stop
@section('title',$title)

@section('content_header')
    <h3>{{ $title }}</h3>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">{{ $title }}</div>
                </div>
                <div class="box-body">
                    @include('admin.message')
                <table class="table table-bordered table-striped dataTable" id="data-table">
                    <thead>
                    <tr>
                        <th  align="center">ID</th>
                        <th  align="left">帐号</th>
                        <th  align="left">姓名</th>
                        <th  align="left">登录时间</th>
                    </tr>
                    </thead>
                    @foreach($data as $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
                    {{--<div class="pull-right">
                        {{ $data->render() }}
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        })
    </script>


@stop
