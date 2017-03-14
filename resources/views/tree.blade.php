@extends('adminlte::page')
@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/bootstrap-treeview-1.2.0/css/bootstrap-treeview.css')}} ">
@stop
@section('title', 'CBAdmin')

@section('content_header')
    <h1>Dashboard</h1>
    <div id="tree"></div>
@stop

@section('content')
    <p>You are logged in!</p>
@stop

@section('js')
    <script src="{{ asset('vendor/bootstrap-treeview-1.2.0/js/bootstrap-treeview.js') }}"></script>
    <script>
        function getTree() {
            // Some logic to retrieve, or generate tree structure
            var tree = [
                {
                    text: "Parent 1",
                    id:1,
                    icon:"fa fa-cog",
                    nodes: [
                        {
                            text: "Child 1",
                            nodes: [
                                {
                                    text: "Grandchild 1"
                                },
                                {
                                    text: "Grandchild 2"
                                }
                            ]
                        },
                        {
                            text: "Child 2"
                        }
                    ]
                },
                {
                    text: "Parent 2"
                },
                {
                    text: "Parent 3"
                },
                {
                    text: "Parent 4"
                },
                {
                    text: "Parent 5"
                }
            ];
            return tree;
        }



        var $checkableTree = $('#tree').treeview({
            data: getTree(),
            showIcon: false,
            showCheckbox: true,
            onNodeChecked: function(event, node) {
                try{
                    var nodes =  $checkableTree.treeview('getParent', node);
                    $checkableTree.treeview('checkNode', [nodes]);
                }catch(err){

                }
                //所有勾选的
                console.log($checkableTree.treeview('getChecked'));
            },
            onNodeUnchecked: function (event, node) {
                var nodes = node.nodes;
                for(i in nodes){
                    $checkableTree.treeview('uncheckNode', [ nodes[i].nodeId, { silent: false }]);
                }
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            /*
            $.post('{{ url('admin/menu') }}','',function(res){
                tree = res;
                var $checkableTree = $('#tree').treeview({
                    data: tree,
                    showIcon: true,
                    showCheckbox: false,
                    showTags: true,
                    onNodeChecked: function(event, node) {
                        try{
                            var nodes =  $checkableTree.treeview('getParent', node);
                            $checkableTree.treeview('checkNode', [nodes]);
                        }catch(err){

                        }
                        //所有勾选的
                        console.log($checkableTree.treeview('getChecked'));
                    },
                    onNodeUnchecked: function (event, node) {
                        var nodes = node.nodes;
                        for(i in nodes){
                            $checkableTree.treeview('uncheckNode', [ nodes[i].nodeId, { silent: false }]);
                        }
                    }
                });
            });
            */
        });

    </script>
@stop