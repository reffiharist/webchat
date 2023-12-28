<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<!--begin::Logo-->
	<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
		<a target="_blank" href="<?=site_url()?>">
			<img alt="Logo" src="<?=base_url('public/assets/admin/media/logos/webchat-dark.svg')?>" class="h-25px app-sidebar-logo-default" />
			<img alt="Logo" src="<?=base_url('public/assets/admin/media/logos/webchat-small.svg')?>" class="h-20px app-sidebar-logo-minimize" />
		</a>

		<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
			<?=svgIcon('icons/duotune/arrows/arr079.svg', 'svg-icon svg-icon-2 rotate-180')?>
		</div>
	</div>
	<!--end::Logo-->

	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'home')?>" href="<?=site_url('backend/home')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/general/gen025.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Dashboard</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
					</div>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=activeMenu(uri_segment(3), ['package', 'addon'], 'hover show')?>">
					<span class="menu-link">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/abstract/abs027.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Packages</span>
						<span class="menu-arrow"></span>
					</span>

					<div class="menu-sub menu-sub-accordion <?=activeMenu(uri_segment(3), ['package', 'addon'], 'show')?>">
						<div class="menu-item">
							<a class="menu-link <?=activeMenu(uri_segment(3), 'package')?>" href="<?=site_url('backend/package')?>">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Package List</span>
							</a>
						</div>

						<div class="menu-item">
							<a class="menu-link <?=activeMenu(uri_segment(3), 'addon')?>" href="<?=site_url('backend/addon')?>">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Add On</span>
							</a>
						</div>
					</div>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'feature')?>" href="<?=site_url('backend/feature')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/general/gen029.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Feature</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'faq')?>" href="<?=site_url('backend/faq')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/general/gen029.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">FAQ</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=activeMenu(uri_segment(3), ['about', 'usecase'], 'hover show')?>">
					<span class="menu-link">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/layouts/lay009.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Content</span>
						<span class="menu-arrow"></span>
					</span>

					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion <?=activeMenu(uri_segment(3), ['about', 'usecase'], 'show')?>">
						<div class="menu-item">
							<a class="menu-link <?=activeMenu(uri_segment(3), 'about')?>" href="<?=site_url('backend/about')?>">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">About Us</span>
							</a>
						</div>
						<div class="menu-item">
							<a class="menu-link <?=activeMenu(uri_segment(3), 'usecase')?>" href="<?=site_url('backend/usecase')?>">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Use Case</span>
							</a>
						</div>
					</div>
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Sales</span>
					</div>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'order')?>" href="<?=site_url('backend/order')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/ecommerce/ecm001.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Orders Listing</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'customer')?>" href="<?=site_url('backend/customer')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/communication/com014.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Customer</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'report')?>" href="<?=site_url('backend/report')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/graphs/gra010.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Reports</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Setting</span>
					</div>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'user')?>" href="<?=site_url('backend/user')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/general/gen049.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Access Login</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'payment-channel')?>" href="<?=site_url('backend/payment-channel')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/finance/fin002.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Payment Channel</span>
					</a>
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link <?=activeMenu(uri_segment(3), 'setting')?>" href="<?=site_url('backend/setting')?>">
						<span class="menu-icon">
							<?=svgIcon('icons/duotune/coding/cod001.svg', 'svg-icon svg-icon-2')?>
						</span>
						<span class="menu-title">Setting</span>
					</a>
				</div>
				<!--end:Menu item-->
			</div>
			<!--end::Menu-->
		</div>
		<!--end::Menu wrapper-->
	</div>
	<!--end::sidebar menu-->
	<!--begin::Footer-->
	<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
		<a href="<?=site_url('backend/logout')?>" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
			<span class="btn-label">Sign Out</span>
			<!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
			<?=svgIcon('icons/duotune/arrows/arr096.svg', 'svg-icon btn-icon svg-icon-2 m-0')?>
			<!--end::Svg Icon-->
		</a>
	</div>
	<!--end::Footer-->
</div>