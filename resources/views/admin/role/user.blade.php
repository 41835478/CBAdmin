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
        <li><a href="{{ url('admin/role/index') }}">角色列表</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h4>{{ $title }}</h4>
                    <div class="box-tools pull-right">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <button data-toggle="modal" data-target=".bs-example-modal-lg"
                        {{--href="{{ url('admin/role/index') }}"--}} class="btn btn-primary"><i class="fa fa-user-md"></i>选择用户</button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body table-responsive">
                    @include('admin.message')
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th  align="center">ID</th>
                        <th  align="left">用户名</th>
                        <th  align="center">操作</th>
                    </tr>
                    </thead>
                    @foreach($data as $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->name }}</td>
                            <td>
                                <a href="{{ url('admin/role/deleteUser',['id'=>$role->id,'userId'=>$val->id]) }}"  class="btn btn-primary btn-xs" title="删除" onclick="return confirm('确定要移除该用户吗？')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">选择用户</h4>
                </div>
                <div class="box no-header">
                    <div class="box-body">
                        <form method="post" action="" id="selectUsersForm">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>请选择用户(可按住[Shift]多选)</label>
                                <select multiple class="form-control" name="userIds[]">
                                    @foreach($optionUsers as $ou)
                                    <option value="{{ $ou->id }}">{{ $ou->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary" id="save">保存</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $('#save').click(function(){
                $('#selectUsersForm').submit();
            });
        });
    </script>
@stop

