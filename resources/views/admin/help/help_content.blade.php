@extends('admin')
@section('title', '帮助中心-内容管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          内容管理
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="help_content_create">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>隶属分类</th>
                <th>标题</th>
                <th>英文标题</th>
                <th>俄文标题</th>

                <th>发布时间</th>
                <th>作者</th>
                <th>查看人数</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
				@if( !empty($data) )
					@foreach( $data as $key => $value )
						<tr>
							<td>{{$value->id}}</td>
							<td>{{$value->helpClass->name}}</td>
							<td>{{$value->title}}</td>
							<td>{{$value->english_title}}</td>
							<td>{{$value->russian_title}}</td>

							<td>{{$value->dateline}}</td>
							<td>{{$value->author}}</td>
							<td>{{$value->view_count}}</td>
							<td>
								<a data-toggle="modal" data-target="#myModal_{{$value->id}}">查看内容</a>
								<a href="help_content_update?id={{$value->id}}">编辑</a>
								<a href="help_content_delete?id={{$value->id}}" onclick="deleteConfirm()">删除</a>
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

@if( !empty($data) )
	@foreach( $data as $k => $val )
		<div id="myModal_{{$val->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel_{{$val->id}}">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="gridSystemModalLabel_{{$val->id}}">内容详情<span style="color:#3498db">{{'-'.$val->title}}</span></h4>
			      </div>
			      <div class="modal-body">
			      	{!! $val->content !!}
			      </div>
		    </div>
		  </div>
		</div>
	@endforeach
@endif


@endsection