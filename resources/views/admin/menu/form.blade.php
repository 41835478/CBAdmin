<form method="post" action="" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-2 control-label">菜单名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="menu[name]" value="{{ old('menu')['name'] ? old('menu')['name']:$menu->name }}" placeholder="菜单名称">
            {{--<input type="hidden" name="menu[id]" value="{{ $menu->id }}">--}}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">上级菜单</label>
        <div class="col-sm-10">
            <select class="form-control" name="menu[pid]" >
                <option value="0">顶级菜单</option>
                @foreach($menus as $m)
                <option value="{{ $m->id }}" @if (old('menu')['pid'] == $m->id || (isset($menu->pid) && $menu->pid == $m->id)) selected="selected" @endif>{{ $m->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">图标</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="menu[icon]" value="{{ old('menu')['icon'] ? old('menu')['icon']:$menu->icon }}" placeholder="图标">
            <span class="help-block m-b-none">更多图标请查看 <a href="http://fontawesome.io/icons/" target="_black">Font Awesome</a></span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">菜单权限</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="菜单权限" name="menu[permission]"
                   value="{{ old('menu')['permission'] ? old('menu')['permission'] : $menu->permission }}">
            权限格式为:控制器名称-方法名称，多个权限用英文逗号分隔 ',' 如 : menu-index,controller-action
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">菜单链接</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="菜单链接" name="menu[url]"
                   value="{{ old('menu')['url'] ? old('menu')['permission'] : $menu->url }}" >
            <span class="help-block m-b-none"> 跟路由保持一致如: admin/menu/create </span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    {{--<div class="form-group">
        <label class="col-sm-2 control-label">菜单高亮地址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="菜单高亮地址" name="menu[active]"
                   value="{{ old('menu')['active'] ? old('menu')['permission'] : $menu->active }}"   >
        </div>
    </div>--}}
    <div class="form-group">
        <label class="col-sm-2 control-label">不显示菜单(仅作权限)</label>
        <div class="col-sm-10">
            是 <input type="radio" name="menu[only_permission]" class="minimal" value="1" @if (old('menu')['only_permission'] == 1 || (isset($menu->only_permission) && $menu->only_permission == 1)) checked @endif>
            否 <input type="radio" name="menu[only_permission]" class="minimal" value="0" @if (old('menu')['only_permission'] != 1 || (isset($menu->only_permission) && $menu->only_permission != 1))  checked @endif>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">描述</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="描述" name="menu[description]"
                   value="{{ old('menu')['description'] ? old('menu')['description'] : $menu->description }}" >
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="排序" name="menu[sort]"
                   value="{{ old('menu')['sort'] ? old('menu')['sort'] : $menu->sort }}"   >
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            {{--<a class="btn btn-white close-link">关闭</a>--}}
            <button type="submit" class="btn btn-primary createButton ladda-button" data-style="zoom-in"><i class="fa fa-paper-plane-o"></i> 提交</button>
        </div>
    </div>
</form>