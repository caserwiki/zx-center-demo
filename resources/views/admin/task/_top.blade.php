<h1>{{$data['name']}}<span>（#{{$data['id']}}）</span></h1>
<div class="row" style="margin-top: 20px; color:#666">
    <div class="col-md-6 col-sm-12 col-12">
        <i class="feather icon-box"></i>
        发布人：{{$users[$data['p1']]['name']}}
    </div>
    <div class="col-md-6 col-sm-12 col-12">
        <i class="feather icon-package"></i>
        执行人：{{$data['p2']}}
    </div>
</div>
