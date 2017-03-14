<form method="post" action="" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-2 control-label">角色名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="role[name]" value="{{ old('role')['name'] ? old('role')['name']:$role->name }}" placeholder="角色名称">
            {{--<input type="hidden" name="role[id]" value="{{ $role->id }}">--}}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="排序" name="role[sort]"
                   value="{{ old('role')['sort'] ? old('role')['sort'] : $role->sort }}"   >
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            {{--<a class="btn btn-white close-link">关闭</a>--}}
            <button type="submit" class="btn btn-primary" data-style="zoom-in"><i class="fa fa-paper-plane-o"></i> 提交</button>
        </div>
    </div>
</form>