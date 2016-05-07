<div class="clearfix"></div>
<div class="footer">
    <h2>Copyright @ 2015</h2>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nanoscroller.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/general.js" ></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nestable.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-switch.min.js" ></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-slider.js" type="text/javascript"></script>

<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="<?php echo site_url('direct/api') ?>"></script>
<script type="text/javascript">
    Ext.require([
        'Ext.direct.*'
    ]);
    Ext.onReady(function () {

        App.init();
        App.dashBoard();

        Ext.ux.extbox.register('a.x-extbox', false, {width: 350, height: 500, title: ''});
        Ext.ux.extbox.register('a.locationinfo', false, {width: 530, height: 500, title: ''});
        Ext.ux.extbox.register('a.orderinfo', false, {width: 830, height: 500, title: ''});
        Ext.ux.extbox.register('a.taskinfo', false, {width: 830, height: 500, title: ''});

        Ext.get('searchorderform1').on('submit', function (e) {
            e.preventDefault();
            Ext.Ajax.request({
                url: '<?php echo site_url('dashboard/ajax/searchorder') ?>',
                method: 'POST',
                params: {searchkey: document.getElementById('searchorder1').value},
                success: function (result, request) {
                    var jsonData = JSON.parse(result.responseText);
                    if (jsonData.status == 'error') {
                        Ext.MessageBox.alert('Message', jsonData.errorMsg);
                    }
                    if (jsonData.status == 'success') {
                        location.href = '<?php echo site_url('dashboard/salesorders') ?>/' + jsonData.salesorderid;
                    }
                }
            });
            return false;
        });

        Ext.get('searchorderform2').on('submit', function (e) {
            e.preventDefault();
            Ext.Ajax.request({
                url: '<?php echo site_url('dashboard/ajax/searchorder') ?>',
                method: 'POST',
                params: {searchkey: document.getElementById('searchorder2').value},
                success: function (result, request) {
                    var jsonData = JSON.parse(result.responseText);
                    if (jsonData.status == 'error') {
                        Ext.MessageBox.alert('Message', jsonData.errorMsg);
                    }
                    if (jsonData.status == 'success') {
                        location.href = '<?php echo site_url('dashboard/salesorders') ?>/' + jsonData.salesorderid;
                    }
                }
            });
            return false;
        });

        function updateMain(count, content) {
            if (count != '0') {
                $('.notification_count').text(count);
                htmlstring = content;
                htmlstring += $("#messages").html();
                $(".notificationsBody").html(htmlstring);
                $("#messages").html(htmlstring);
            }
        }

        Ext.direct.Manager.addProvider(Ext.app.REMOTING_API, {
            type: 'polling',
            interval: 150000,
            url: '<?php echo site_url('direct/messages/poll') ?>',
            listeners: {
                data: function (provider, event) {
                    updateMain(event.msgcount, event.data);
                }
            }
        });

        $(".notificationLink").click(function ()
        {
            $(".notificationContainer").fadeToggle(300);
            return false;
        });
        $(document).click(function (e)
        {
            $(".notificationContainer").hide();
        });

        $(".notificationContainer").click(function (e)
        {
            if (e.target.tagName.toLowerCase() == 'a') {
                if ($(e.target).attr('rel') == 'more') {
                    location.href = $(e.target).attr('href');
                    return false;
                }

                if ($(e.target).attr('rel') != 'more') {
                    Ext.Ajax.request({
                        url: '<?php echo site_url('direct/messages/messageread') ?>/' + $(e.target).attr('rel'),
                        method: 'GET',
                        success: function (result, request) {
                            if (result.responseText == 'done') {
                                location.href = $(e.target).attr('href') + '/show';
                                return true;
                            }
                        }
                    });
                    return false;
                }
            }
            return false;
        });
    });
</script>

<div style="display:none" id="messages"></div>

</div>
</div>
</body>
</html>