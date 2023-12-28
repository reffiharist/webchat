<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
		<title>Login Webchat</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="<?=base_url('public/assets/admin/media/logos/favicon.ico')?>" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="<?=base_url('public/assets/admin/plugins/global/plugins.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('public/assets/admin/css/style.bundle.css')?>" rel="stylesheet" type="text/css" />
	</head>

	<body data-kt-name="metronic" id="kt_body" class="bgi-size-cover bgi-position-center bgi-no-repeat">
		<script>if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }</script>

		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background: url('<?=base_url("public/images/bg-line.png")?>') no-repeat #233259; } [data-theme="dark"] body { background: url('<?=base_url("public/images/bg-line.png")?>') #233259; }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<!--begin::Aside-->
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<!--begin::Aside-->
					<div class="d-flex flex-column">
						<!--begin::Logo-->
						<a href="<?=site_url()?>" class="mb-7">
							<img alt="Logo" src="<?=base_url('public/images/logo-webchat-white.png')?>" width="220px" />
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
						<h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2>
						<!--end::Title-->
					</div>
					<!--begin::Aside-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-center w-lg-50 p-10">
					<!--begin::Card-->
					<div class="card rounded-3 w-md-550px">
						<!--begin::Card body-->
						<div class="card-body p-10 p-lg-20">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="<?=site_url('backend/home')?>" action="#">
								<div class="text-center mb-11">
									<h1 class="text-dark fw-bolder mb-3">Sign In</h1>
									<div class="text-gray-500 fw-semibold fs-6">Your Webchat Application</div>
								</div>
								<div class="fv-row mb-8">
									<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" required />
								</div>
								<div class="fv-row mb-3">
									<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" required />
								</div>
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<a href="<?=site_url('backend/forgot')?>" class="link-primary">Forgot Password ?</a>
								</div> 
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<span class="indicator-label">Sign In</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
								<a href="<?=site_url('backend/register')?>" class="link-primary">Sign up</a></div>
							</form>
							<!--end::Form-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->

		<script>var hostUrl = "assets/";</script>
		<script>var baseUrl = "<?=base_url()?>";</script>
		<script src="<?=base_url('public/assets/admin/plugins/global/plugins.bundle.js')?>"></script>
		<script src="<?=base_url('public/assets/admin/js/scripts.bundle.js')?>"></script>
		<script src="<?=base_url('public/assets/admin/custom/login.js')?>"></script>
	</body>
	<!--end::Body-->
</html>