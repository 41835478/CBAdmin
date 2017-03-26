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
                    <div class="box-tools pull-right">
                        <a href="{{ url('admin/words/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>敏感词管理</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    @include('admin.message')
                <table class="table table-bordered table-responsive table-hover">
                    <thead>
                    <tr>
                        <th  align="center">ID</th>
                        <th  align="left">敏感词</th>
                        <th  align="left">添加时间</th>

                    </tr>
                    </thead>
                    @foreach($data as $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
                    <div class="pull-right">
                        {{ $data->render() }}
                    </div>

                    <div class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Default Modal</h4>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body…</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

