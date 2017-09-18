@extends('admin')
@section('title', '推广奖励管理')

@section('content')

<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>
          奖励列表
        </span>
      </div>
      <div class="panel-body pn">
        <div   class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>被奖励用户</th>
                <th>奖励Btc数量</th>
                <th>奖励来源用户</th>
                <th>类型</th>
                <th>创建时间</th>
              </tr>
            </thead>
            <tbody>
              @if( !empty($data) )
                @foreach( $data as $key => $value )
                  <tr>
                    <td>{{$value->id}}</td>
                    <td>{{!empty($value->user) ? $value->user->mobile : ''}}</td>
                    <td>{{$value->btc_amount}}</td>
                    <td>{{$value->source_user_mobile}}</td>
                    <td>{{$value->description}}</td>
                    <td>{{$value->create_time}}</td>
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