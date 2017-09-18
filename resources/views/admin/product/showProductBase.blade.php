@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
 <h4>产品基类管理 - {{ !empty($data) ? '更新' : '新增' }}</h4>

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
      <label class="col-lg-3 control-label">基类名称</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="name" class="form-control" placeholder="请输入基类名称，必填" value="{{ !empty($data) ? $data['name'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">发行总额</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="total_value" class="form-control" placeholder="请输入发行总额，必填" value="{{ !empty($data) ? $data['total_value'] : 0 }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">年化预期收益率区间</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="rate_range" class="form-control" placeholder="请输入年化预期收益率区间，选填" value="{{ !empty($data) ? $data['rate_range'] : 0 }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">预计每7天收益</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="about_week_income" class="form-control" placeholder="请输入预计每7天收益，选填" value="{{ !empty($data) ? $data['about_week_income'] : 0 }}">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">对应合同模板</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select name="contract_id" class="form-control">
            @if( !empty( $contract ) )
              @foreach($contract as $key => $val)
                @if( !empty($data) && $data['contract_id'] == $val['id'] )
                  <option value="{{$val['id']}}" selected="selected">{{$val['title_buy']}}</option>
                @else
                  <option value="{{$val['id']}}">{{$val['title_buy']}}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">算力类型</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <select name="product_hash_type" class="form-control">
            @if( !empty( $product_type ) )
              @foreach($product_type as $key => $val)
                @if( !empty($data) && $data['product_hash_type'] == $val['id'] )
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

    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection