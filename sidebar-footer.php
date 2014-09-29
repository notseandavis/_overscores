<?php
/**
 * Footer widget areas.
 */

// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar('footer-widget-1') + is_active_sidebar('footer-widget-2') + is_active_sidebar('footer-widget-3') + is_active_sidebar('footer-widget-4');
// default
$footergrid = "col-sm-12";
// if only one
if ($footerwidgets == "1") {
$footergrid = "col-sm-12";
// if two, split in half
} elseif ($footerwidgets == "2") {
$footergrid = "col-sm-12 col-md-6";
// if three, divide in thirds
} elseif ($footerwidgets == "3") {
$footergrid = "col-sm-12 col-md-4";
// if four, split in fourths
} elseif ($footerwidgets == "4") {
$footergrid = "col-sm-12 col-md-3";
}

?>

<?php if ($footerwidgets) : ?>

<?php if (is_active_sidebar('footer-widget-1')) : ?>
<div class="<?php echo $footergrid;?>">
	<?php dynamic_sidebar('footer-widget-1'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer-widget-2')) : $last = ($footerwidgets == '2' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar('footer-widget-2'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer-widget-3')) : $last = ($footerwidgets == '3' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar('footer-widget-3'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer-widget-4')) : $last = ($footerwidgets == '4' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
		  <?php dynamic_sidebar('footer-widget-4'); ?>
</div>
<?php endif;?>
<div class="clear"></div>

<?php endif;?>