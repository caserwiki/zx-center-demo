<div class="markdown-body editormd-html-preview">
    <form id="task-store" action="store" method="POST">
        {{ csrf_field() }}
        <div class="row events">
            <div class="col-md-1 col-sm-1 col-12 time_y">
                {{date("Y")}}
            </div>
            <div class="col-md-1 col-sm-1 col-12 time_md">
                <i class="fa fa-circle"></i>
                <span>{{date("m-d")}}</span>
                <span class="time_hi">{{date("H:i")}}</span>
            </div>
            <div class="col-md-2 col-sm-2 col-12">
                <img class="avatar" src="/uploads/{{Admin::user()->avatar}}" alt="">
                <span class="users">{{Admin::user()->name}}</span>
            </div>
            <div class="col-md-8 col-sm-8 col-12 content">
                <div class="row">
                    <div class="col-md-10 col-sm-19 col-12">
                        <textarea class="form-control" rows="3" placeholder="发布跟进记录..." name="description">{{ old('content') }}</textarea>
                        <input type="hidden" name="product" value="{{$data['product']}}">
                        <input type="hidden" name="parent_id" value="{{$data['id']}}">
                        <input type="hidden" name="p1" value="{{$data['p1']}}">
                        <input type="hidden" name="p2" value="{{$data['p2']}}">
                    </div>
                    <div class="col-md-2 col-sm-2 col-12">
                        <button type="submit" class="btn btn-primary">发布</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @foreach ($events as $event)
    @if ($event['id'])
    <div class="row events contentlist">
        <div class="col-md-1 col-sm-1 col-12 time_y">
            {{$event['created_at']->format('Y')}}</div>
        <div class="col-md-1 col-sm-1 col-12 time_md"><i class="fa fa-circle"></i>
            <span>{{$event['created_at']->format('m-d')}}</span>
            <span class="time_hi">{{$event['created_at']->format('H:i')}}</span></div>
        <div class="col-md-2 col-sm-2 col-12">
            <img class="avatar" src="/uploads/{{$users[$event['p1']]['avatar']}}" alt="">
            <span class="users">{{$users[$event['p1']]['name']}}</span>
        </div>
        <div class="col-md-8 col-sm-8 col-12 content">
            <div class="row" style="overflow: hidden;">
                <div class="col-md-11 col-sm-11 col-12">
                    <?=$event['description'];?>
                </div>
                {{--<div class="col-md-1 col-sm-1 col-12 tools">
                    <form action="{{ route('task.destroy', $event->id) }}" method="post" class="float-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                            <i class="feather icon-trash"></i>
                        </button>
                    </form>
                </div>--}}
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>

<script>
    Zx.ready(function () {
        // ajax表单提交
        $('#task-store').form({
            validate: true, //开启表单验证
            before: function (fields, form, opt) {
                let $post = [];
                $.each(fields, function(i, item){
                    $post[item['name']] = item['value'];
                });

                if ($post['description'].length === 0) {
                    Zx.error('无效提交');
                    return false;
                }
                if ($post['parent_id'] != {{$data['id']}}) {
                    Zx.error('校验失败请刷新界面');
                    return false;
                }
            },
            success: function (response) {
                // data 为接口返回数据
                if (! response.status) {
                    Zx.error(response.data.message);
                    return false;
                }

                Zx.success(response.data.message);

                Zx.reload("{{admin_url('task/' . $data['id'])}}");
                /*if (data.redirect) {
                    Zx.reload(response.data.value);
                }*/
                return false;
            },
            error: function (response) {
                // 当提交表单失败的时候会有默认的处理方法，通常使用默认的方式处理即可
                let errorData = JSON.parse(response.responseText);

                if (errorData) {
                    Zx.error(errorData.message);
                } else {
                    console.log('提交出错', response.responseText);
                }

                // 终止后续逻辑执行
                return false;
            },
        });
    });
</script>
