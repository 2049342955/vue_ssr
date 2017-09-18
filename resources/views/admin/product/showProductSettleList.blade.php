@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          产品结算
        </span>
      </div>

      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>产品总量</th>
                <th>收益时间</th>
                <th>实际收益</th>
                <th>电费</th>
                <th>状态</th>
                <th>算力类型</th>
                <th>录入人</th>
                <th>录入时间</th>
              </tr>
            </thead>
            <tbody>
      				@if( !empty($data) )
      					@foreach( $data as $key => $value )
      						<tr>
      							<td>{{$value->id}}</td>
      							<td>{{$value->hash_total}}</td>
      							<td>{{$value->payable_time}}</td>
      							<td>{{$value->mine_amount}}</td>
      							<td>{{$value->electricity_fees}}</td>
                    
                    <td>
                      @if($value->status == 0)
                        已计算
                        <a href="product/settle/insert/{{$value->id}}">录入收益</a>
                      @elseif($value->status == 1)
                        已录入
                        <a href="product/settle/allow_distribution/{{$value->id}}">允许分配</a>
                      @elseif($value->status == 2)
                        允许分配
                        <a href="product/settle/distribution/{{$value->id}}" onclick="distributeConfirm()">分配</a>
                      @elseif($value->status == 3)
                        已分配
                        <a href="product/settle/checkaccess/{{$value->id}}" onclick="checkConfirm()">审核通过</a>
                      @elseif($value->status == 4)
                        已审核
                        <a href="product/settle/transfer/{{$value->id}}" onclick="transferConfirm()">转账</a>
                      @elseif($value->status == 5)
                        已转账
                      @else
                        其他
                      @endif
                    </td>
                    <td>
                      {{ isset($value->hashtype) && !empty($value->hashtype) ? $value->hashtype->name : ''}}
                    </td>
      							<td>{{$value->mine_user}}</td>
                    <td>{{$value->mine_time}}</td>
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