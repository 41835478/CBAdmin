@extends('adminlte::page')
@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/bootstrap-treeview-1.2.0/css/bootstrap-treeview.css')}} ">
@stop
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
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        权限列表
                    </div>
                </div>
                <div class="box-body">
                    <div id="menu"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <h3 class="font-bold">角色名称：{{ $role->name }}</h3>
                    你可以操作左侧权限列表，或者点击下面更新按钮更新权限！<br/><br/>
                <form action="{{ url('admin/role/updatePermission',['id'=>$role->id]) }}" method="post" id="updateForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="menuIds" id="menuIds"/>
                </form>
                <a href="javascript:;" class="btn btn-primary" id="update-btn"><i class="fa fa-save"></i> 更新 </a>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="{{ asset('vendor/bootstrap-treeview-1.2.0/js/bootstrap-treeview.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            //导步加载菜单数据
            var menu;
            $.post('{{ $data_url }}','',function(res){
                    menu = $('#menu').treeview({
                    data: res,
                    showIcon: false,
                    showCheckbox: true,
                    //showTags: true,
                    onNodeChecked: function(event, node) {
                        try{
                            var childNodes = node.nodes;
                            var nodes =  menu.treeview('getParent', node);
                            menu.treeview('checkNode', [nodes]);
                            var i;
                            for (i in childNodes){
                                menu.treeview('checkNode', [ childNodes[i].nodeId, { silent: false }]);
                            }
                        }catch(err){

                        }
                        //所有勾选的
                        console.log(menu.treeview('getChecked'));
                    },
                    onNodeUnchecked: function (event, node) {
                        var nodes = node.nodes;
                        var i;
                        for(i in nodes){
                            menu.treeview('uncheckNode', [ nodes[i].nodeId, { silent: false }]);
                        }
                    }
                });
            });

            $('#update-btn').click(function(){
                var checked_nodes = menu.treeview('getChecked');
                var idsArray = [],i;
                for (i in checked_nodes){
                    idsArray[i] = checked_nodes[i].id;
                }
                var ids =  idsArray.join(',');
                console.log(ids);
                $('#menuIds').val(ids);
                $('#updateForm').submit();
            });
        });


    </script>
@stop