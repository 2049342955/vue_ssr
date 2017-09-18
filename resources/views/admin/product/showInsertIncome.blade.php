@extends('admin')
@section('title', '产品管理')

@section('content')

<div id="content">
 <h4>录入收益</h4>

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
      <label class="col-lg-3 control-label">实际收益(已扣除电费)</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="mine_amount" class="form-control" placeholder="请输入实际收益，必填" value="{{ !empty($data) ? $data['mine_amount'] : '' }}" required="required">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">电费</label>
      <div class="col-lg-8">
        <div class="bs-component">
          <input type="text" name="electricity_fees" class="form-control" placeholder="请输入电费，必填" value="{{ !empty($data) ? $data['electricity_fees'] : 0 }}" required="required">
        </div>
      </div>
    </div>

    <div class="text-right">
      <button type="submit" class="btn btn-default ph25">提交</button>
    </div>
  </form>
</div>

@endsection