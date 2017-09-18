@extends('admin')
@section('title', '同类产品介绍')

@section('content')

<div id="content">
 <h4><a onclick="history.go(-1)">{{$base_data['name']}}</a> - {{ !empty($data) ? '更新' : '新增' }}</h4>

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
      <label class="col-lg-3 control-label">标题</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="title" class="form-control" placeholder="请输入标题，必填" value="{{ !empty($data) ? $data['title'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">作者</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="author" class="form-control" placeholder="请输入作者，必填" value="{{ !empty($data) ? $data['modify_user'] : session('admin_info')['true_name'] }}" required="required">
        </div>
      </div>
    </div>


    <div class="form-group">
      <label class="col-lg-3 control-label">介绍内容</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <!-- 加载编辑器的容器 -->
          @if( !empty($data) )
            <script id="container" name="content" type="text/plain">{!! $data['content'] !!}</script>
          @else
            <script id="container" name="content" type="text/plain"></script>
          @endif

          @include('ueditor.ueditor')
        </div>
      </div>
    </div>



    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection