@extends('admin')
@section('title', '转让产品管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          转让列表
        </span>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>发起用户</th>
                <th>商品名称</th>
                <th>转让数量</th>
                <th>转让单价</th>
                <th>原始总价</th>
                <th>算力类型</th>
                <th>状态</th>
                <th>创建时间</th>
              </tr>
            </thead>
            <tbody>
              @if( !empty($data) )
                @foreach( $data as $key => $value )
                  <tr>
                    <td>{{$value->id}}</td>
                    <td>{{!empty($value->user) ? $value->user->mobile : ''}}</td>
                    <td>{{$value->product_name}}</td>
                    <td>{{$value->transfer_amount}}</td>
                    <td>{{$value->transfer_price}}</td>
                    <td>{{$value->original_price}}</td>
                    <td>{{isset($value->hashtype) && !empty($value->hashtype) ? $value->hashtype->name : ''}}</td>
                    <td>
                      @if($value->status == 1)
                        转让中
                      @elseif($value->status == 2)
                        <span class="green">成功</span>
                      @elseif($value->status == 3)
                        <span class="red">已撤销</span>
                      @else
                        其他
                      @endif
                    </td>
                    <td>{{$value->created_time}}</td>
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