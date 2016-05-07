<div class="cl-sidebar" data-position="right" data-step="1" data-intro="<strong>Fixed Sidebar</strong> <br/> It adjust to your needs." >
    <div class="cl-toggle" style="text-align:right; padding-right: 15px;"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">
                <?php $this->load->view('templates/main/sidebar-user'); ?>
                <ul class="cl-vnavigation">
                    <li><a href="#"><i class="fa fa-group"></i><span>All</span></a></li>
                    <li><a href="#"><i class="fa fa-user"></i><span>High Priority SO</span></a></li>
                    <li><a href="#"><i class="fa fa-user-times"></i><span>Unassigned SO</span></a></li>
                    <li><a href="#"><i class="fa fa-building-o"></i><span>Build SO</span></a></li>
                    <li><a href="#"><i class="fa fa-exchange"></i><span>Shipped SO</span></a></li>
                    <li><a href="#"><i class="fa fa-truck"></i><span>Deliverd SO</span><span class="fa caret"></span></a>
                        <ul class="sub-menu">
                            <li><a href="#" >Test1</a></li>
                            <li><a href="#" >Test2</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
            <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
    </div>
</div>