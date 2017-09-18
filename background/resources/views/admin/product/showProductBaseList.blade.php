@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          产品基类管理
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="product/base/save">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>基类名称</th>
                <th>产品发行总额</th>
                <th>年化收益率区间</th>
                <th>添加时间</th>
                <th>预期7天收益</th>
                <th>操作员</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
				@if( !empty($data) )
					@foreach( $data as $key => $value )
						<tr>
							<td>{{$value->id}}</td>
							<td>{{$value->name}}</td>
							<td>{{$value->total_value}}</td>
							<td>{{$value->rate_range}}</td>
							<td>{{$value->modify_time}}</td>
							<td>{{$value->about_week_income}}</td>
							<td>{{$value->modify_user}}</td>
							<td>
                <a href="product/base/save?id={{$value->id}}">编辑</a>
								<a href="product/base/introduction/{{$value->id}}">同类产品介绍</a>
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