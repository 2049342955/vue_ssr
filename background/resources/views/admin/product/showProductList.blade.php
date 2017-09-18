@extends('admin')
@section('title', '产品管理')

@section('content')

<header id="topbar" class="ph10">

  <div class="topbar-left">
    <form action="product/manage/search" method="get">
      <div class="col-sm-12">
          <div class="col-sm-6">
              <input type="text" name="search" class="form-control" placeholder="请输入产品名称进行查询" value="{{isset($search) ? $search : ''}}" required="required">
          </div>
          <div class="col-sm-2">
              <button type="submit" class="btn btn-default">查询</button>
          </div>
      </div>
    </form>
  </div>

</header>

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          产品管理
        </span>

		<div class="pull-right hidden-xs">
           <span><a href="product/manage/save">新增</a></span>
        </div>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>产品名称</th>
                <th>产品英文名</th>
                <th>产品俄文名</th>
                <th>产品基类</th>
                <th>起售时间</th>
                <th>产品总量</th>
                <th>单步数量</th>
                <th>产品单价</th>
                <th>已融额度</th>
                <th>算力类型</th>
                <th>状态</th>
                <th>是否首页展示</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
      				@if( !empty($data) )
      					@foreach( $data as $key => $value )
      						<tr>
      							<td>{{$value->id}}</td>
      							<td>{{$value->name}}</td>
                    <td>{{$value->english_name}}</td>
                    <td>{{$value->russian_name}}</td>
      							<td>{{!empty($value->product_base) ? $value->product_base->name : ''}}</td>
      							<td>{{$value->sell_start_time}}</td>
      							<td>{{$value->amount}}</td>
      							<td>{{$value->buy_step_amount}}</td>
                    <td>{{$value->one_amount_value}}</td>
                    <td>{{$value->buyed_amount}}</td>
                    <td>{{isset($value->hashtype) && !empty($value->hashtype) ? $value->hashtype->name : ''}}</td>
      							<td>
                      @if($value->status == 1)
                        审核中
                        <a href="product/manage/changestatus/2?id={{$value->id}}">通过</a>
                        <a href="product/manage/changestatus/3?id={{$value->id}}" class="red">拒绝</a>
                      @elseif($value->status == 2)
                        审核通过
                        <a href="product/manage/changestatus/4?id={{$value->id}}">预热</a>
                        <a href="product/manage/changestatus/5?id={{$value->id}}">可投</a>
                        <a href="product/manage/changestatus/3?id={{$value->id}}" class="red">拒绝</a>
                      @elseif($value->status==3)
                        审核未通过
                      @elseif($value->status==4)
                        预热
                        <a href="product/manage/changestatus/5?id={{$value->id}}">可投</a>
                      @elseif($value->status==5)
                        可投
                        <a href="product/manage/changestatus/6?id={{$value->id}}">截止</a>
                        <a href="product/manage/changestatus/9?id={{$value->id}}">下架</a>
                      @elseif($value->status==6)
                        已截止
                      @elseif($value->status==7)
                        已售罄
                      @elseif($value->status==8)
                        已结清
                      @elseif($value->status==9)
                        已下架
                      @else
                        其他
                      @endif
                    </td>
                    <td>
                      @if($value->is_top == 1)
                        <span class="green">是</span>
                        <a href="product/manage/top/0?id={{$value->id}}">修改</a>
                      @else
                        <span>否</span>
                        <a href="product/manage/top/1?id={{$value->id}}">修改</a>
                      @endif
                    </td>
      							<td>
                      <a href="product/manage/save?id={{$value->id}}">编辑</a>
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