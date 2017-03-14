@extends('adminlte::page')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/bootstrap-treeview-1.2.0/css/bootstrap-treeview.css')}} ">
@stop
@section('title', '菜单列表')

@section('content_header')
    <h3>菜单列表</h3>
    <ol class="breadcrumb no-border">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">菜单列表</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">菜单列表</div>
                    <div class="box-tools">
                        <a href="{{ url('admin/menu/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>创建菜单</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    @include('admin.message')
                <table class="table table-bordered table-responsive table-hover">
                    <thead>
                    <tr>
                        <th  align="center">排序</th>
                        <th  align="center">ID</th>
                        <th  align="left">菜单名称</th>
                        <th >菜单权限标识</th>
                        <th  align="center">菜单链接</th>
                        <th  align="center">菜单图标</th>
                        <th  align="center">操作</th>
                    </tr>
                    </thead>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->sort }}</td>
                            <td>{{ $menu->id }}</td>
                            <td>{{ $menu->name }}<i class="{{ $menu->icon }}"></i></td>
                            <td>{{ $menu->permission }}</td>
                            <td>{{ $menu->url }}</td>
                            <td>{{ $menu->icon }}</td>
                            <td>
                                <a href="{{ url('admin/menu/create',['pid'=>$menu->id]) }}"  class="btn btn-primary btn-xs" title="添加子菜单"><i class="fa fa-plus"></i></a>
                                {{--<a href="#"  class="btn btn-primary btn-xs" title="查看"><i class="fa fa-eye"></i></a>--}}
                                <a href="{{ url('admin/menu/update',['id'=>$menu->id]) }}"  class="btn btn-primary btn-xs" title="编辑"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('admin/menu/delete',['id'=>$menu->id]) }}"  class="btn btn-primary btn-xs" title="删除" onclick="return confirm('确定要删除该菜单吗？')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/bootstrap-treeview-1.2.0/js/bootstrap-treeview.js') }}"></script>

    <script>

        $(function(){
            $('#create-menu-box').hide();
            $('.create_menu').click(function(){
                $('.add-box').hide();
                $('#create-menu-box').show();
            });

        });
    </script>
@stop