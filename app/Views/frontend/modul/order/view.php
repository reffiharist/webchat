<div id="title-page">
	<div class="content-title-page">
		<h2>Order Package</h2>
		<p>Border-less account pricing</p>
	</div>
</div>

<section id="order">
	<div class="container">
		<form id="formOrder" action="#" onsubmit="submitOrder(); return false;">
			<input type="hidden" name="package" value="<?=encrypt($data->package_id)?>">

			<div class="row">
				<div class="col-lg-8">
					<div class="card card-custom mb-4">
						<div class="card-header">Order Item</div>
						<div class="card-body">
							<div class="list-order">
								<div class="item-list-order">
									<div class="content-list-order">
										<h5>Package <?=$data->package_name?></h5>
										<ul class="ul">
											<?php foreach ($desc as $key => $value): ?>
												<li><?=$value?></li>
											<?php endforeach ?>
										</ul>								
									</div>
									<div class="price-list-order">
										Rp. <?=angka($data->package_price)?>/Bln
									</div>
								</div>

								<?php $n = 1; foreach ($addon as $d): ?>
									<div class="item-list-order">
										<div class="content-list-order">
											<div class="radio-list-order">
												<div class="form-check">
													<input class="form-check-input" type="radio" value="<?=$d->addon_id?>" name="addon" id="addon<?=$n?>" data-label="Add On <?=$d->addon_name?>" data-price="<?=$d->addon_price?>">
													<label class="form-check-label" for="addon<?=$n?>">
														Add On <?=$d->addon_name?>
													</label>
												</div>

												<p><?=$d->addon_number?> Whatsapp Number + <?=angka($d->addon_message)?> messages</p>
											</div>
										</div>

										<div class="price-list-order">
											Rp. <?=angka($d->addon_price)?>
										</div>
									</div>
								<?php $n++; endforeach ?>
							</div>
						</div>
						<!-- card-body -->
					</div>
					<!-- card -->

					<div class="card card-custom mb-4">
						<div class="card-header">Durasi Paket</div>
						<div class="card-body">
							<label class="mb-3">Pilih durasi paket yang sesuai dengan kebutuhan anda</label>
							<div class="wrap-durasi">
								<?php foreach ($duration as $key => $value): ?>
									<?php $price = $data->package_price * $key; ?>
									<?php $checked = $key == 1 ? "checked" : ""; ?>
									<label class="item-durasi">
										<input <?=$checked?> type="radio" name="durasi" value="<?=$key?>" data-label="<?=$value?>" data-price="<?=$price?>">
										<div class="content-durasi">
											<span><?=$value?></span>
											<h5>Rp <?=angka($price)?></h5>
										</div>
									</label>
								<?php endforeach ?>
							</div>
						</div>
					</div>

					<div class="card card-custom mb-4">
						<div class="card-header">Pembayaran</div>
						<div class="card-body">
							<div class="form-group mb-3">
								<label class="mb-2">Metode Pembayaran</label>
								<select name="payment_method" class="form-select" required>
									<option value="">Select Pembayaran</option>
									<?php foreach ($method as $key => $value): ?>
										<option value="<?=encrypt($key)?>"><?=$value?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group">
								<label class="mb-2">Payment Channel</label>
								<select name="payment_channel" class="form-select" required>
									<option value="">Select Channel</option>
									<?php foreach ($channel as $d): ?>
										<option value="<?=encrypt($d->channel_id)?>"><?=$d->channel_name?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card card-custom sticky-summary mb-4">
						<div class="card-header">Summary Order</div>
						<div class="card-body">
							<ul class="ul summary-list">
								<li id="mainPrice">
									<div class="content-summary-list">
										<h5>Package <?=$data->package_name?></h5>
										<p id="durationPackage">1 Bulan</p>
									</div>
									
									<div class="price-summary-list" id="pricePackage">Rp <?=angka($data->package_price)?></div>
								</li>

								<li>
									<div class="content-summary-list">
										<h5>Biaya Admin</h5>
									</div>
									
									<div class="price-summary-list" id="feePrice">Rp -</div>
								</li>
							</ul>

							<div id="summary-total">Total <span id="totalPayment">Rp -</span></div>
						</div>
					</div>
				</div>
			</div>

			<div>
				<button class="btn btn-primary btn-submit-order" type="submit">Submit Order</button>
			</div>
		</form>
	</div>
</section>

<script>
$(function() {

	var baseUrl = "<?=site_url()?>";
	var priceDefault = '<?=$data->package_price?>';
	var pricePackage = parseInt(priceDefault);
	var priceAddon = 0;
	var priceFee = 0;
	var priceTotal = 0;

	$('.btn-submit-order').prop('disabled', true);

	$('[name=durasi]').on('click', function () {
		var price = $(this).data('price');
		var label = $(this).data('label');

		$('#durationPackage').text(label);
		$('#pricePackage').text('Rp ' + price.toLocaleString("de-DE"));

		// Update price
		pricePackage = price;

		// Reset Form
		resetData();
	});

	$('[name=addon]').on('click', function () {
		var price = $(this).data('price');
		var label = $(this).data('label');
		var tags = `<div class="content-summary-list"><h5>${label}</h5></div><div class="price-summary-list">Rp ${price.toLocaleString("de-DE")}</div>`;

		if($('#addonPrice').length) {
			$('#addonPrice').html(tags);
		} else {
			$('#mainPrice').after(`<li id="addonPrice">${tags}</li>`);
		}

		// Update price
		priceAddon = price;

		// Reset Form
		resetData();
	});

	$('[name=payment_method]').on('change', function() {
		var payMethod = $(this).val();

		$.ajax({
	        type     : "POST",
	        url      : baseUrl + "/order/getChannel",
	        data     : {payMethod: payMethod},
	        dataType : "json",
	        error    : function (xhr, status, error) {
	            alert("An error occurred");
	        },
	        success  : function(data) {
	            $('[name=payment_channel]').html(data.list);
	        },
	    });
	});

	$('[name=payment_channel]').on('change', function () {
		var channel = $(this).val();
		var price = pricePackage + priceAddon;

		$.ajax({
	        type     : "POST",
	        url      : baseUrl + "/order/getFee",
	        data     : { channel: channel, price: price },
	        dataType : "json",
	        error    : function (xhr, status, error) {
	            alert("An error occurred");
	        },
	        success  : function(data) {
	            $('#feePrice').text('Rp ' + data.fee.toLocaleString("de-DE"));

	            // Update fee
	            priceFee = data.fee;

	            // Update Total Payment
	            var total = pricePackage + priceAddon + priceFee;
	            priceTotal = total;

	            $('#totalPayment').text('Rp ' + total.toLocaleString("de-DE"));

	            // Update button
	            $('.btn-submit-order').prop('disabled', false);
	        },
	    });
	});

	function resetData() {
		$('[name=payment_method]').prop('selectedIndex',0); 
		$('[name=payment_channel]').prop('selectedIndex',0); 
		$('#feePrice').text('Rp -');
		$('#totalPayment').text('Rp -');
		$('.btn-submit-order').prop('disabled', true);
	}
});

function submitOrder() {
	
}
</script>