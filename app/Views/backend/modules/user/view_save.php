<div class="card card-flush">
	<div class="card-header align-items-center py-5 gap-2 gap-md-5">
		<div class="card-title">
			<div class="d-flex align-items-center position-relative my-1">
				<?=svgIcon('icons/duotune/general/gen021.svg', 'svg-icon svg-icon-1 position-absolute ms-4')?>
				<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search User" />
			</div>
		</div>
		
		<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
			<?=svgIcon('icons/duotune/arrows/arr075.svg', 'svg-icon svg-icon-2')?>
			Add User</button>
		</div>
	</div>

	<div class="card-body pt-0">
		<table class="table align-middle table-row-dashed fs-6 gy-5" id="mc_user_table">
			<thead>
				<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
					<th class="min-w-125px">Name</th>
					<th class="min-w-125px">Email</th>
					<th class="min-w-125px">Level</th>
					<th class="min-w-125px">Status</th>
					<th class="min-w-125px">Last Login</th>
					<th class="text-end min-w-100px">Action</th>
				</tr>
			</thead>
			<tbody class="text-gray-600 fw-semibold">
				<tr>
					<td class="d-flex align-items-center">
						<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
							<a href="../../demo1/dist/apps/user-management/users/view.html">
								<div class="symbol-label fs-3 bg-light-danger text-danger">R</div>
							</a>
						</div>
						<div class="d-flex flex-column">
							<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
							<span>smith@kpmg.com</span>
						</div>
					</td>
					<td>admin@mail.com</td>
					<td>Admin</td>
					<td><span class="badge badge-light-success">Active</span></td>
					<td><?=date("d M Y, H:i")?></td>
					<td class="text-end">
						<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
							<?=svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0')?>
						</a>

						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
							<div class="menu-item px-3">
								<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">Edit</a>
							</div>

							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="d-flex align-items-center">
						<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
							<a href="../../demo1/dist/apps/user-management/users/view.html">
								<div class="symbol-label fs-3 bg-light-danger text-danger">R</div>
							</a>
						</div>
						<div class="d-flex flex-column">
							<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
							<span>smith@kpmg.com</span>
						</div>
					</td>
					<td>reffizalharist@gmail.com</td>
					<td>User</td>
					<td><span class="badge badge-light-success">Active</span></td>
					<td><?=date("d M Y, H:i")?></td>
					<td class="text-end">
						<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
							<?=svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0')?>
						</a>
						
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
							<div class="menu-item px-3">
								<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">Edit</a>
							</div>
							
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="d-flex align-items-center">
						<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
							<a href="../../demo1/dist/apps/user-management/users/view.html">
								<div class="symbol-label fs-3 bg-light-danger text-danger">R</div>
							</a>
						</div>
						<div class="d-flex flex-column">
							<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
							<span>smith@kpmg.com</span>
						</div>
					</td>
					<td>udin@gmail.com</td>
					<td>User</td>
					<td><span class="badge badge-light-success">Active</span></td>
					<td><?=date("d M Y, H:i")?></td>
					<td class="text-end">
						<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
							<?=svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0')?>
						</a>
						
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
							<div class="menu-item px-3">
								<a href="../../demo1/dist/apps/user-management/users/view.html" class="menu-link px-3">Edit</a>
							</div>
							
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!--end::Card body-->
</div>

<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
			<div class="modal-header" id="kt_modal_add_user_header">
				<h2 class="fw-bold">Add User</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
					<?=svgIcon('icons/duotune/arrows/arr061.svg', 'svg-icon svg-icon-1')?>
				</div>
			</div>
			<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				<form id="kt_modal_add_user_form" class="form" action="#">
					<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
						
						<div class="fv-row mb-7">
							<label class="required fw-semibold fs-6 mb-2">Full Name</label>
							<input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="Emma Smith" />
						</div>
						<div class="fv-row mb-7">
							<label class="required fw-semibold fs-6 mb-2">Email</label>
							<input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="smith@kpmg.com" />
						</div>
						<div class="fv-row mb-7">
							<label class="required fw-semibold fs-6 mb-2">Level</label>
							<select class="form-select form-select-solid mb-3 mb-lg-0" name="user_level" aria-label="Select level">
							    <option>Select</option>
							    <option value="1">One</option>
							    <option value="2">Two</option>
							    <option value="3">Three</option>
							</select>
						</div>
					</div>
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->