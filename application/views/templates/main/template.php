<?php
$this->load->view('templates/main/default-header');

if (file_exists(APPPATH . '/modules/' . $page . '/views/' . $page . '-sidebar.php')) {
    $this->load->view($page . '-sidebar.php');
} else {
    $this->load->view('templates/main/default-sidebar');
}
//$this->load->view('templates/main/' . $sidebar);
//$this->load->view('template/main/' . $main_content);
?>

<div class="container-fluid" id="pcont">
    <div class="page-head">
        <h3><?php echo $pagetitle; ?></h3>
        <?php if (isset($breadcrumb) && sizeof($breadcrumb) > 0): ?>
            <ol class="breadcrumb">
                <?php foreach ($breadcrumb as $b_item): ?>
                    <?php if ($b_item['active'] == TRUE): ?>
                        <li class="active"><?php echo $b_item['name']; ?></li>
                    <?php else: ?>
                        <li><a href="<?php echo site_url($b_item['url']); ?>"><?php echo $b_item['name']; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
    <!-- Content wrapper -->
    <div class="col-md-12">
        <div class="block-flat">
            <?php if (isset($removeheader) && $removeheader == true) { ?>
            <?php } else { ?>
                <div class="header">
                    <h3><?php echo $content_title; ?></h3>
                </div>
            <?php } ?>
            <div class="content">
                <div class="table-responsive">
                    
                    <?php
                    $this->load->view($main_content);
                    ?>
                </div><!--contentwrapper-->

            </div><!-- centercontent -->

        </div>
    </div>
    <!-- End of Content wrapper -->

    <?php
    $this->load->view('templates/main/default-footer');
    ?>


