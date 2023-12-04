<div class="card card-flush">
	<div class="card-header align-items-center py-5 gap-2 gap-md-5">
		<div class="card-title">
			<div class="d-flex align-items-center position-relative my-1">
				<?=svgIcon('icons/duotune/general/gen021.svg', 'svg-icon svg-icon-1 position-absolute ms-4')?>
				<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search User" />
			</div>
		</div>
		
		<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
			<button type="button" class="btn btn-primary" onclick="add()">
			<?=svgIcon('icons/duotune/arrows/arr075.svg', 'svg-icon svg-icon-2')?>
			Add User</button>
		</div>
	</div>

	<div class="card-body pt-0">
		<table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTable">
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
			<tbody class="text-gray-600 fw-semibold"></tbody>
		</table>
	</div>
	<!--end::Card body-->
</div>

<div class="modal fade" id="kt_modal_user" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
			<div class="modal-header" id="kt_modal_add_user_header">
				<h2 class="fw-bold">Add User</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<?=svgIcon('icons/duotune/arrows/arr061.svg', 'svg-icon svg-icon-1')?>
				</div>
			</div>
			<div class="modal-body scroll-y px-10 px-lg-15 pb-15">
				<form id="form" class="form" action="#" onsubmit="save(); return false" method="post">
					<input type="hidden" name="id">
					
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Full Name</label>
						<input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Email</label>
						<input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Level</label>
						<select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-hide-search="true" name="level" aria-label="Select level" required>
    						<option value="" disabled>Select</option>
						    <?php foreach ($adminType as $key => $val): ?>
    						    <option value="<?=$key?>"><?=$val?></option>
						    <?php endforeach ?>
						</select>
					</div>

					<div class="fv-row mb-7" data-kt-password-meter="true">
						<label class="required fw-semibold fs-6 mb-2">Password</label>
						<div class="mb-1">
							<div class="position-relative mb-3">
								<input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" />
								<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
									<i class="bi bi-eye-slash fs-2"></i>
									<i class="bi bi-eye fs-2 d-none"></i>
								</span>
							</div>
							<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
							</div>
						</div>
						<div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
					</div>

					<div class="fv-row mb-7">
						<input placeholder="Repeat Password" name="copassword" type="password" autocomplete="off" class="form-control bg-transparent" />
					</div>
					
					<div class="text-center pt-10">
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