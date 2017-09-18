@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
 <h4>产品管理 - {{ !empty($data) ? '更新' : '新增' }}</h4>

  <hr class="alt short">
  <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    @if(!empty($data))
      <div class="form-group">
          <label class="col-lg-3 control-label">ID</label>
          <div class="col-lg-8">
              <div class="bs-component">
                  <p class="form-control-static text-muted">{{$data['id']}}</p>
                  <input type="hidden" name="id" value="{{$data['id']}}">
              </div>
          </div>
      </div>
    @endif

    <div class="form-group">
      <label class="col-lg-3 control-label">产品名称</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="name" class="form-control" placeholder="请输入产品名称，必填" value="{{ !empty($data) ? $data['name'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">产品英文名</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="english_name" class="form-control" placeholder="请输入产品英文名，必填" value="{{ !empty($data) ? $data['english_name'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">产品俄文名</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="russian_name" class="form-control" placeholder="请输入产品俄文名，必填" value="{{ !empty($data) ? $data['russian_name'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">所属产品基类</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select name="product_base_id" class="form-control">
            @if( !empty( $product_base ) )
              @foreach($product_base as $key => $val)
                @if( !empty($data) && $data['product_base_id'] == $val['id'] )
                  <option value="{{$val['id']}}" selected="selected">{{$val['name']}}</option>
                @else
                  <option value="{{$val['id']}}">{{$val['name']}}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">起售时间</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="datetime-local" name="sell_start_time" class="form-control" value="{{ !empty($data) ? $data['sell_start_time2'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">停止销售时间</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="datetime-local" name="sell_end_time" class="form-control" value="{{ !empty($data) ? $data['sell_end_time2'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">起息时间</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="datetime-local" name="income_start_time" class="form-control" value="{{ !empty($data) ? $data['income_start_time2'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">结息时间</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="datetime-local" name="income_end_time" class="form-control" value="{{ !empty($data) ? $data['income_end_time2'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">产品总量</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="number" name="amount" class="form-control" value="{{ !empty($data) ? $data['amount'] : 0 }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">产品单价(￥)</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="one_amount_value" class="form-control" value="{{ !empty($data) ? $data['one_amount_value'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">起投数量</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="buy_min_amount" class="form-control" value="{{ !empty($data) ? $data['buy_min_amount'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">单步数量</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="buy_step_amount" class="form-control" value="{{ !empty($data) ? $data['buy_step_amount'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">单笔购买数量限制</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="single_limit_amount" class="form-control" value="{{ !empty($data) ? $data['single_limit_amount'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">用户购买数量限制</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="user_limit_amount" class="form-control" value="{{ !empty($data) ? $data['user_limit_amount'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">是否仅限新手</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select class="form-control" name="buy_only_new_user">
            @if(!empty($data) && $data['buy_only_new_user'] == 0)
              <option value="0" selected="selected">否</option>
            @else
              <option value="0">否</option>
            @endif
            @if(!empty($data) && $data['buy_only_new_user'] == 1)
              <option value="1" selected="selected">是</option>
            @else
              <option value="1">是</option>
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">转让模式</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select class="form-control" name="assign_mode">
            @if(!empty($data) && $data['assign_mode'] == 0)
              <option value="0" selected="selected">不可转让</option>
            @else
              <option value="0">不可转让</option>
            @endif
            @if(!empty($data) && $data['assign_mode'] == 1)
              <option value="1" selected="selected">可转让</option>
            @else
              <option value="1">可转让</option>
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">转让持有期 (秒)</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="assign_freeze_period" class="form-control" value="{{ !empty($data) ? $data['assign_freeze_period'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">起息模式（如1表示T+1）</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="income_start_mode" class="form-control" value="{{ !empty($data) ? $data['income_start_mode'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">每T电费(￥)</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="power_fee" class="form-control" value="{{ !empty($data) ? $data['power_fee'] : '0' }}" required="required">
        </div>
      </div>
    </div>

    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection