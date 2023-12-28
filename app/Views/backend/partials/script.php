<script>var hostUrl = "<?=base_url('public/assets/admin/')?>";</script>
<script>var baseUrl = "<?=base_url()?>";</script>

<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="<?=base_url('public/assets/admin/plugins/global/plugins.bundle.js')?>"></script>
<script src="<?=base_url('public/assets/admin/js/scripts.bundle.js')?>"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Vendors Javascript(used by this page)-->
<script src="<?=base_url('public/assets/admin/plugins/custom/datatables/datatables.bundle.js')?>"></script>
<!--end::Vendors Javascript-->

<script src="<?=base_url('public/assets/admin/custom/global.js')?>"></script>

<?php if (isset($script)): ?>
	<?php if (is_array($script)): ?>
		<?php foreach ($script as $key => $value): ?>
			<?php echo $value; ?>
		<?php endforeach ?>
	<?php else: ?>
		<?php echo $script; ?>
	<?php endif ?>
<?php endif ?>