<div class="card card-flush">
	<div class="card-header align-items-center py-5 gap-2 gap-md-5">
		<div class="card-title">
			<div class="d-flex align-items-center position-relative my-1">
				<?=svgIcon('icons/duotune/general/gen021.svg', 'svg-icon svg-icon-1 position-absolute ms-4')?>
				<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Addon" />
			</div>
		</div>
		
		<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
			<button type="button" class="btn btn-primary" onclick="add()">
			<?=svgIcon('icons/duotune/arrows/arr075.svg', 'svg-icon svg-icon-2')?>
			Add Addon</button>
		</div>
	</div>

	<div class="card-body pt-0">
		<table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTable">
			<thead>
				<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
					<th class="min-w-125px">Name</th>
					<th class="min-w-125px">Number</th>
					<th class="min-w-125px">Message</th>
					<th class="min-w-125px">Price</th>
					<th class="min-w-125px">Type</th>
					<th class="min-w-125px">Status</th>
					<th class="text-end min-w-100px">Action</th>
				</tr>
			</thead>
			<tbody class="text-gray-600 fw-semibold"></tbody>
		</table>
	</div>
	<!--end::Card body-->
</div>

<div class="modal fade" id="kt_modal_addon" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
			<div class="modal-header" id="kt_modal_add_addon_header">
				<h2 class="fw-bold">Add Addon</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<?=svgIcon('icons/duotune/arrows/arr061.svg', 'svg-icon svg-icon-1')?>
				</div>
			</div>
			<div class="modal-body scroll-y px-10 px-lg-15 pb-15">
				<form id="form" class="form" action="#" onsubmit="save(); return false" method="post">
					<input type="hidden" name="id">
					
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Addon Name</label>
						<input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Addon name" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Number of Numbers</label>
						<input type="number" name="number" class="form-control form-control-solid mb-3 mb-lg-0" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Number of Messages</label>
						<input type="number" name="message" class="form-control form-control-solid mb-3 mb-lg-0" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Price</label>
						<input type="number" name="price" class="form-control form-control-solid mb-3 mb-lg-0" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Type</label>
						<select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-hide-search="true" name="type" aria-label="Select type" required>
    						<option value="" disabled>Select</option>
						    <?php foreach ($type as $key => $val): ?>
    						    <option value="<?=$key?>"><?=$val?></option>
						    <?php endforeach ?>
						</select>
					</div>
					
					<div class="text-center pt-10">
						<button type="reset" class="btn btn-light me-3" data-kt-addon-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-addon-modal-action="submit">
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