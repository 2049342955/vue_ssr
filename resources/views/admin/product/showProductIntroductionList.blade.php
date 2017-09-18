@extends('admin')
@section('title', '基类管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          产品介绍-{{$base_data['name']}}
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="product/base/introduction/save/{{$base_id}}">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>介绍标题</th>
                <th>撰写人</th>
                <th>添加时间</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
				@if( !empty($data) )
					@foreach( $data as $key => $value )
						<tr>
							<td>{{$value->id}}</td>
							<td>{{$value->title}}</td>
							<td>{{$value->modify_user}}</td>
							<td>{{$value->modify_time}}</td>
							<td>
                <a href="product/base/introduction/save/{{$base_id}}?id={{$value->id}}">编辑</a>
                <a href="product/base/introduction/delete/{{$base_id}}?id={{$value->id}}">删除</a>
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