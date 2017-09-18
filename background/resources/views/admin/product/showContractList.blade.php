@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          合同模板管理
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="product/contract/save">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>协议标题</th>
                <th>协议内容</th>
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
      							<td>
                      @if(!empty($value->title_buy))
                        {{$value->title_buy}}
                      @else
                        {{$value->title_transfer}}
                      @endif       
                    </td>
      							<td>
                      <a href="product/contract/preview?id={{$value->id}}" target="_blank">协议内容</a>       
                    </td>
      							<td>{{$value->modify_user}}</td>
      							<td>{{$value->modify_time}}</td>
      							<td>
                      <a href="product/contract/save?id={{$value->id}}">编辑</a>
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