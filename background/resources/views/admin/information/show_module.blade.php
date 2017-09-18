@extends('admin')
@section('title', '信息模块管理')

@section('content')

<div id="content">
 <h4>模块管理 - {{ !empty($data) ? '更新' : '新增' }}</h4>

  <hr class="alt short">
  <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    @if(!empty($data))
        <div class="form-group">
            <label class="col-lg-3 control-label">ID</label>
            <div class="col-lg-8">
                <div class="bs-component">
                    <p class="form-control-static text-muted">{{$data['id']}}</p>
                    <input type="hidden" name="id" value="{{$data['id']}}">
                </div>
            </div>
        </div>
    @endif

    <div class="form-group">
      <label class="col-lg-3 control-label">模块名称</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="name" class="form-control" placeholder="请输入模块名称，必填" value="{{ !empty($data) ? $data['name'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">模块排序</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="number" name="display_order" class="form-control" placeholder="请输入模块排序，必填" value="{{ !empty($data) ? $data['display_order'] : '' }}" required="required">
        </div>
      </div>
    </div>



    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection