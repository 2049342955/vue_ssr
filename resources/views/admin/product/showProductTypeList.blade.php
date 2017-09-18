@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          算力类型管理
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="product/hashtype/save">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>类型名称</th>
                <th>创建时间</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
      				@if( !empty($data) )
      					@foreach( $data as $key => $value )
      						<tr>
      							<td>{{$value->id}}</td>
      							<td>{{$value->name}}</td>
                    <td>{{$value->created_time}}</td>
      							<td>
                     <a href="product/hashtype/save?id={{$value->id}}">编辑</a>       
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