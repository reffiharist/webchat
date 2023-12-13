<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<base href="<?=site_url()?>">
		<title>Administrator System</title>
		<meta charset="utf-8" />
		<meta name="description" content="Webchat Administrator System" />
		<meta name="keywords" content="Webchat Administrator System" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Webchat Administrator System" />
		<meta property="og:url" content="<?=site_url()?>" />
		<meta property="og:site_name" content="Webchat | Si-Prima" />
		<?php echo $this->include('backend/partials/style'); ?>
	</head>
	<!--end::Head-->

	<!--begin::Body-->
	<body data-kt-name="webchat" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<?php echo $this->include('backend/partials/header'); ?>
				<!--end::Header-->

				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::sidebar-->
					<?php echo $this->include('backend/partials/sidebar'); ?>
					<!--end::sidebar-->

					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Toolbar-->
							<?php echo $this->include('backend/partials/toolbar'); ?>
							<!--end::Toolbar-->

							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
									<!--begin::Content page-->
									<?php echo $this->include('backend/modules/'.$page); ?>
									<!--end::Content page-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						<?php echo $this->include('backend/partials/footer'); ?>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<?=svgIcon('icons/duotune/arrows/arr066.svg', 'svg-icon')?>
		</div>
		<!--end::Scrolltop-->

		<!--begin::Javascript-->
		<?php echo $this->include('backend/partials/script'); ?>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>