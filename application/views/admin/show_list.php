<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<h3><span class="glyphicon glyphicon-send"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h3>
<br>

<?php if(isset($add_url) && $add_url != NULL):?>
<a href="<?php if(isset($add_url)) echo $add_url; else echo "#"?>" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span> اضافه کردن </a>
<?php endif;?>

<table class="datatable table table-hover table-striped table-bordered" cellspacing="0" width="100%">
<?php echo $table?>
</table>

</div>
</div>