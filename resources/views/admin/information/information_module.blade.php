@extends('admin')
@section('title', '信息-模块管理')

@section('content')


<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          模块管理
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="information/module_create">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>名称</th>
                <th>排序</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
				@if( !empty($data) )
					@foreach( $data as $key => $value )
						<tr>
							<td>{{$value->id}}</td>
							<td>{{$value->name}}</td>
							<td>{{$value->display_order}}</td>
							<td>
								<a href="information/module_update?id={{$value->id}}">编辑</a>
								<a href="information/module_delete?id={{$value->id}}" onclick="deleteConfirm()">删除</a>
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