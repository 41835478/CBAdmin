<form method="post" action="" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-2 control-label">名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="word[name]" value="{{ old('word')['name'] ? old('word')['name']:$word->name }}" placeholder="名称">
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary" data-style="zoom-in"><i class="fa fa-paper-plane-o"></i> 提交</button>
        </div>
    </div>
</form>