@extends('admin')
@section('title', '数字货币')

@section('content')

<header id="topbar" class="ph10">

  <div class="topbar-left">
    <form action="digitalcoin/transfer/search" method="get">
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
          兑换列表
        </span>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>手机号</th>
                <th>兑换数量</th>
                <th>兑换金额</th>
                <th>币类型</th>
                <th>创建时间</th>
                <th>状态</th>
              </tr>
            </thead>
            <tbody>
              @if( !empty($data) )
                @foreach( $data as $key => $value )
                  <tr>
                    <td>{{$value->id}}</td>
                    <td>{{!empty($value->user) ? $value->user->mobile : ''}}</td>
                    <td>{{$value->btc_amount}}</td>
                    <td>{{$value->value}}</td>
                    <td>{{isset($value->hashtype) && !empty($value->hashtype) ? $value->hashtype->name : ''}}</td>
                    <td>{{$value->create_time}}</td>
                    <td>
                      @if($value->status == 0)
                        待处理
                      @elseif($value->status == 1)
                        处理中
                      @elseif($value->status == 2)
                        <span class="green">成功</span>
                      @elseif($value->status == 3)
                        <span class="red">失败</span>
                      @endif
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