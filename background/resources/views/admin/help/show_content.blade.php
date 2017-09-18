@extends('admin')
@section('title', '帮助中心管理')

@section('content')

<div id="content">
 <h4>内容管理 - {{ !empty($data) ? '更新' : '新增' }}</h4>

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
      <label class="col-lg-3 control-label">英文标题</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="english_title" class="form-control" placeholder="请输入英文标题，必填" value="{{ !empty($data) ? $data['english_title'] : '' }}" required="required">
        </div>
      </div>
    </div>



    <div class="form-group">
      <label class="col-lg-3 control-label">俄文标题</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="russian_title" class="form-control" placeholder="请输入俄文标题，必填" value="{{ !empty($data) ? $data['russian_title'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">作者</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="author" class="form-control" placeholder="请输入作者，必填" value="{{ !empty($data) ? $data['author'] : session('admin_info')['true_name'] }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">隶属分类</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select name="help_class_id" class="form-control">
            @if( !empty( $cate ) )
              @foreach($cate as $key => $val)
                @if( !empty($data) && $data['help_class_id'] == $val->id )
                  <option value="{{$val->id}}" selected="selected">{{$val->name}}</option>
                @else
                  <option value="{{$val->id}}">{{$val->name}}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">内容</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <!-- 加载编辑器的容器 -->
          @if( !empty($data) )
            <script id="container" name="content" type="text/plain">{!! $data['content'] !!}</script>
          @else
            <script id="container" name="content" type="text/plain"></script>
          @endif

         
        </div>
      </div>
    </div>


    <div class="form-group">
      <label class="col-lg-3 control-label">英文内容</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <!-- 加载编辑器的容器 -->
          @if( !empty($data) )
            <script id="english_container" name="english_content" type="text/plain">{!! $data['english_content'] !!}</script>
          @else
            <script id="english_container" name="english_content" type="text/plain"></script>
          @endif

          
      </div>
    </div>


    <div class="form-group">
      <label class="col-lg-3 control-label">俄文内容</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <!-- 加载编辑器的容器 -->
          @if( !empty($data) )
            <script id="russian_container" name="russian_content" type="text/plain">{!! $data['russian_content'] !!}</script>
          @else
            <script id="russian_container" name="russian_content" type="text/plain"></script>
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