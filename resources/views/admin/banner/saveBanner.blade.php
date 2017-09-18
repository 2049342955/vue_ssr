@extends('admin')
@section('title', 'banner设置')

@section('content')

<div id="content">
 <h4>banner设置 - {{ !empty($data) ? '更新' : '新增' }}</h4>

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
      <label class="col-lg-3 control-label">上传图片</label>
      <div class="col-lg-8">
        <div class="bs-component">
            <input type="file" name="image" class="form-control" >
        </div>
      </div>
    </div>

    @if(isset($data['image']))
    <div class="form-group">
      <label class="col-lg-3 control-label">查看图片</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <img src="{{$data['image']}}" width="100px" height="auto">
          <input type="hidden" name="old_image" value="{{$data['image']}}" class="form-control" >
        </div>
      </div>
    </div>
    @endif

    <div class="form-group">
      <label class="col-lg-3 control-label">标题</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="title" class="form-control" placeholder="请输入标题，必填" value="{{ !empty($data) ? $data['title'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">链接地址</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="url" class="form-control" placeholder="请输入链接地址，必填" value="{{ !empty($data) ? $data['url'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">链接类型</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select name="url_type" class="form-control">
            @if(isset($data['url_type']) && $data['url_type'] == "normal")
              <option value="normal" selected="selected">normal</option>
            @else
              <option value="normal">normal</option>
            @endif

            @if(isset($data['url_type']) && $data['url_type'] == "outlink")
              <option value="outlink" selected="selected">outlink</option>
            @else
              <option value="outlink">outlink</option>
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">终端类型</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="endpoint" class="form-control" placeholder="请输入终端类型，选填" value="{{ !empty($data) ? $data['endpoint'] : 'pc' }}">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">所属页面位置</label>
      <div class="col-lg-8">
        <div class="bs-component">

          <select name="position" class="form-control">
            @if(isset($data['position']) && $data['position'] == "friend")
              <option value="friend" selected="selected">friend</option>
            @else
              <option value="friend">friend</option>
            @endif

            @if(isset($data['position']) && $data['position'] == "new_finance")
              <option value="new_finance" selected="selected">new_finance</option>
            @else
              <option value="new_finance">new_finance</option>
            @endif

            @if(isset($data['position']) && $data['position'] == "finance_question")
              <option value="finance_question" selected="selected">finance_question</option>
            @else
              <option value="finance_question">finance_question</option>
            @endif

            @if(isset($data['position']) && $data['position'] == "home")
              <option value="home" selected="selected">home</option>
            @else
              <option value="home">home</option>
            @endif

            @if(isset($data['position']) && $data['position'] == "partner")
              <option value="partner" selected="selected">partner</option>
            @else
              <option value="partner">partner</option>
            @endif
          </select>

        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">备注信息</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="remark" class="form-control" placeholder="请输入备注信息，选填" value="{{ !empty($data) ? $data['remark'] : '' }}">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">排序顺序</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="display_order" class="form-control" placeholder="请输入排序顺序，选填" value="{{ !empty($data) ? $data['display_order'] : '50' }}">
        </div>
      </div>
    </div>

    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection