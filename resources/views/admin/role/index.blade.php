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
                        <a href="{{ url('admin/role/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>创建角色</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    @include('admin.message')
                <table class="table table-bordered table-responsive table-hover">
                    <thead>
                    <tr>
                        <th  align="center">排序</th>
                        <th  align="center">ID</th>
                        <th  align="left">角色名称</th>
                        <th  align="center">操作</th>
                    </tr>
                    </thead>
                    @foreach($data as $val)
                        <tr>
                            <td>{{ $val->sort }}</td>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->name }}</td>
                            <td>
                                <a href="{{ url('admin/role/update',['id'=>$val->id]) }}"  class="btn btn-primary btn-xs" title="编辑"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('admin/role/permission',['id'=>$val->id]) }}"  class="btn btn-primary btn-xs" title="编辑权限"><i class="fa fa-users"></i></a>
                                <a href="{{ url('admin/role/user',['id'=>$val->id]) }}"  class="btn btn-primary btn-xs" title="设置用户"><i class="fa fa-user"></i></a>
                                <a href="{{ url('admin/role/delete',['id'=>$val->id]) }}"  class="btn btn-primary btn-xs" title="删除" onclick="return confirm('确定要删除该角色吗？')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
@stop

