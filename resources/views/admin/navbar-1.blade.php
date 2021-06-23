<ul class="nav navbar-nav">
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="true">
            <i class="ficon feather icon-bell"></i>
            <?php if ($task > 0) {
                echo '<span class="badge badge-pill badge-primary badge-up">' . $task . '</span>';
            } ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right ">
            <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                    <h3 class="white"><?= $task;?> New</h3><span class="grey darken-2">App Notifications</span>
                </div>
            </li>
            <li class="scrollable-container media-list ps ps--active-y">
                <a class="d-flex justify-content-between" href="<?= admin_url('task');?>">
                    <div class="media d-flex align-items-start">
                        <div class="media-left"><i class="feather icon-airplay font-medium-5 primary"></i></div>
                        <div class="media-body">
                            <h6 class="primary media-heading">You have <?= $task;?> unfinished jobs!</h6>
                            <small class="notification-text">Go for it!</small>
                        </div>
                    </div>
                </a>
                <?php if (!empty($weather)) {?>
                <a class="d-flex justify-content-between" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left"><i class="feather <?= $weather['now']['icon']?> font-medium-5 success"></i></div>
                        <div class="media-body">
                            <h6 class="success media-heading darken-1"><?= $weather['now']['text']?>(实时)</h6>
                            <small class="notification-text"><?= $weather['now']['temp']?></small>
                            <small class="notification-text"><?= $weather['now']['rh']?></small>
                            <small class="notification-text"><?= $weather['now']['wind']?></small>
                            <br />
                            <small class="notification-text">全天:</small>
                            <small class="notification-text"><?= $weather['0']['text']?></small>
                            <small class="notification-text"><?= $weather['0']['temp']?></small>
                        </div>
                        <small>
                            <time class="media-meta"  datetime="<?= $weather['now']['time']?>"><?= $weather['now']['time']?></time>
                        </small>
                    </div>
                </a>
                <a class="d-flex justify-content-between" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left"><i class="feather <?= $weather['1']['icon']?> font-medium-5 danger"></i></div>
                        <div class="media-body">
                            <h6 class="danger media-heading darken-3"><?= $weather['1']['text']?></h6>
                            <small class="notification-text"><?= $weather['1']['temp']?></small>
                            <small class="notification-text"><?= $weather['1']['wind']?></small>
                        </div>
                        <small>
                            <time class="media-meta" datetime=""><?= $weather['1']['time']?></time>
                        </small>
                    </div>
                </a>
                <?php }?>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 254px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 184px;"></div>
                </div>
            </li>
            {{--<li class="dropdown-menu-footer">
                <a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a>
            </li>--}}
        </ul>
    </li>
</ul>
