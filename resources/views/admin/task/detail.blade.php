<div class="card-header">
    <div>
        <h4 class="card-title">描述</h4>
    </div>
</div>

<div class="box-body">
    <span class="sale" style="overflow: hidden;">
        <?=$data['description'];?>
    </span>
    <span class="time">
        <i class="feather icon-clipboard"></i>
        计划完成：{{$data['finish_at']}}
    </span>
    <span class="time">
        <i class="feather icon-paperclip"></i>
        发布日期：{{$data['created_at']}}
    </span>
</div>
