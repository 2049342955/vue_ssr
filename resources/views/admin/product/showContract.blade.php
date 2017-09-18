@extends('admin')
@section('title', '合同模板管理')

@section('content')

<div id="content">
 <h4>合同模板管理 - {{ !empty($data) ? '更新' : '新增' }}</h4>

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
      <label class="col-lg-3 control-label">协议标题</label>
      <div class="col-lg-8">
        <div class="bs-component">
          @if(!empty($data))
            @if(!empty($data['title_buy']))
              <input type="text" name="title" class="form-control" placeholder="请输入协议名称，必填" value="{{$data['title_buy']}}" required="required">
            @else
              <input type="text" name="title" class="form-control" placeholder="请输入协议名称，必填" value="{{$data['title_transfer']}}" required="required">
            @endif
          @else
            <input type="text" name="title" class="form-control" placeholder="请输入协议名称，必填" required="required">
          @endif
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">协议类型</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select name="contract_type" class="form-control">
            @if(!empty($data) && !empty($data['title_buy']))
              <option value="0" selected="selected">购买协议</option>
            @else
              <option value="0">购买协议</option>
            @endif

            @if(!empty($data) && !empty($data['title_transfer']))
              <option value="1" selected="selected">转让协议</option>
            @else
              <option value="1">转让协议</option>
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">协议内容</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <!-- 加载编辑器的容器 -->
          @if( !empty($data) )
            @if(!empty($data['title_buy']))
              <textarea class="form-control" rows="100" name="content">{{ $data['content'] }}</textarea>
            @else
              <textarea class="form-control" rows="100" name="content">{{ $data['transfer_content'] }}</textarea>
            @endif
          @else
            <textarea class="form-control" name="content"></textarea>
          @endif
        </div>
      </div>
    </div>

    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection