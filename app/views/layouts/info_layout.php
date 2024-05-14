<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="<?php print_link(SITE_FAVICON); ?>" />
	<title><?php echo $this->get_page_title();; ?></title>
	<?php
	Html::page_meta('theme-color', META_THEME_COLOR);
	Html::page_meta('author', META_AUTHOR);
	Html::page_meta('keyword', META_KEYWORDS);
	Html::page_meta('description', META_DESCRIPTION);
	Html::page_meta('viewport', META_VIEWPORT);
	Html::page_css('font-awesome.min.css');
	Html::page_css('animate.css');
	Html::page_css('blueimp-gallery.css');
	?>
	<?php
	Html::page_css('bootstrap-theme-united.css');
	Html::page_css('custom-style.css');
	Html::page_js('sidebarmenu.js');
	Html::page_js('app.min.js');

	Html::page_js('dashboard.js');
	Html::page_template('bootstrap.bundle.min.js');

	Html::page_css('styles.min.css');
	Html::page_simplebar('simplebar.js');
	?>
	<?php
	Html::page_js('jquery-3.3.1.min.js');
	Html::page_css('bootstrap-editable.css');
	Html::page_css('dropzone.min.css');
	Html::page_jquery('jquery.min.js');
	Html::page_js('chartjs-2.3.0.js');
	?>
	<style>
		#main-content {
			padding: 0;
			min-height: 500px;
		}
	</style>
</head>

<body style="padding-top:50px;">
	<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
		<a class="navbar-brand" href="<?php print_link('') ?>">
			<img class="img-responsive" src="<?php print_link(SITE_LOGO); ?>" />
			<?php echo SITE_NAME ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">

			</ul>
		</div>
	</nav>
	<div id="main-content" class="mt-4">
		<div id="page-content">
			<?php $this->render_body(); ?>
		</div>
		<?php
		$this->render_view('appfooter.php');
		?>
	</div>
	<?php
	Html::page_js('popper.js');
	Html::page_js('bootstrap-4.3.1.min.js');
	?>
</body>

</html>
