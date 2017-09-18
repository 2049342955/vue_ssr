@extends('admin')
@section('title', '数字货币')

@section('content')

<header id="topbar" class="ph10">

  <div class="topbar-left">
    <form action="digitalcoin/withdraw/search" method="get">
      <div class="col-sm-12">
          <div class="col-sm-6">
              <input type="text" name="search" class="form-control" placeholder="请输入手机号进行查询" required="required" value="{{isset($search) ? $search : ''}}">
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
          提币列表
        </span>
      </div>
      <div class="panel-body pn">
        <div class="bs-component table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>申请人</th>
                <th>收款地址</th>
                <th>提币数量</th>
                <th>手续费</th>
                <th>类型</th>
                <th>状态</th>
                <th>申请时间</th>
                <th>打款人</th>
                <th>打款时间</th>
              </tr>
            </thead>
            <tbody>
              @if( !empty($data) )
                @foreach( $data as $key => $value )
                  <tr>
                    <td>{{$value->id}}</td>
                    <td>{{!empty($value->user) ? $value->user->mobile : ''}}</td>
                    <td>{{$value->btc_addr}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->fee}}</td>
                    <td>{{isset($value->hashtype) && !empty($value->hashtype) ? $value->hashtype->name : ''}}</td>
                    <td>
                      @if($value->status == 0)
                        待处理
                        <a href="digitalcoin/withdraw/checkaccess?id={{$value->id}}" onclick="distributeConfirm()">审核通过</a>
                        <a href="digitalcoin/withdraw/cancel?id={{$value->id}}" onclick="distributeConfirm()">取消</a>
                      @elseif($value->status == 1)
                        处理中
                        <a href="digitalcoin/withdraw/transferdone?id={{$value->id}}" onclick="distributeConfirm()">操作完成</a>
                        <a href="digitalcoin/withdraw/cancel?id={{$value->id}}" onclick="distributeConfirm()">取消</a>
                      @elseif($value->status == 2)
                        <span class="green">已完成</span>
                      @elseif($value->status == 3)
                        <span class="red">已取消</span>
                      @endif
                    </td>
                    <td>{{$value->apply_time}}</td>
                    <td>{{$value->pay_username}}</td>
                    <td>{{$value->pay_time}}</td>
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