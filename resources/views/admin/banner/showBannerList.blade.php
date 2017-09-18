@extends('admin')
@section('title', 'banner管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          banner管理
        </span>

    <div class="pull-right hidden-xs">
           <span><a href="banner/savebanner">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>图片</th>
                <th>链接地址</th>
                <th>链接类型</th>
                <th>终端类型</th>
                <th>所属位置</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @if( !empty($data) )
                @foreach( $data as $key => $value )
                  <tr>
                    <td>{{$value->id}}</td>
                    <td><img src="{{$value->image}}" width="30px" height="auto"></td>
                    <td>{{$value->url}}</td>
                    <td>{{$value->url_type}}</td>
                    <td>{{$value->endpoint}}</td>
                    <td>{{$value->position}}</td>
                    <td>
                      <a href="banner/savebanner?id={{$value->id}}">编辑</a>
                      <a href="banner/delete?id={{$value->id}}" onclick="deleteConfirm()">删除</a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>

          @if( !empty( $data ) )
            <div class="text-right">
              <?php echo $data->render(); ?>
            </div>
          @endif
      </div>
  </div>
</div>

@endsection