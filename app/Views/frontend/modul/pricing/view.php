<div id="title-page">
	<div class="content-title-page">
		<h2>Pricing</h2>
		<p>Border-less account pricing</p>
	</div>
</div>

<section id="pricing">
	<div class="container">
		<div class="title-content center">
			<h2>Choose The Pricing Plan</h2>
			<p>Pilih paket sesuai kebutuhan anda</p>
		</div>

		<div id="price-detail">
			<?php foreach ($price as $d): ?>
				<div class="section-price">
					<h2 class="title-price"><?=$d['price']['key']?></h2>
					<div class="wrap-price">
						<?php foreach ($d['package'] as $p): ?>
							<?php $lists = explode(',', $p->package_desc); ?>
							<div class="item-price">
								<div class="box-title-price">
									<h3><?=$p->package_name?></h3>
									<h4><sup>IDR</sup> <?=angka($p->package_price)?> <span>/bulan</span></h4>
								</div>
								<div class="box-content-price">
									<ul>
										<?php foreach ($lists as $key => $value): ?>
											<li><?=$value?></li>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="box-action-price">
									<a class="default-btn" href="<?=site_url('order/package/'.encrypt($p->package_id))?>">Register Now</a>
								</div>
							</div>
						<?php endforeach ?>

						<?php
							$minPrice = null;
							$maxPrice = null;
							$listAddon = "";
							foreach ($d['addon'] as $a) {
								$listAddon .= "<li>".$a->addon_number." number +  ".angka($a->addon_message)." message Rp ".angka($a->addon_price)."</li>";

								$priceAddon = $a->addon_price;

							    if ($minPrice === null || $priceAddon < $minPrice) {
							        $minPrice = $priceAddon;
							    }

								if ($maxPrice === null || $priceAddon > $maxPrice) {
							        $maxPrice = $priceAddon;
							    }
							}
						?>
						<div class="item-price">
							<div class="box-title-price">
								<h3>Add On</h3>
								<h4><sup>IDR</sup> <?=angka($minPrice)?> - <?=angka($maxPrice)?></h4>
							</div>
							<div class="box-content-price">
								<ul>
									<?=$listAddon?>
								</ul>
							</div>
							<div class="box-action-price">
								<a class="default-btn" href="<?=site_url('contact')?>">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<section id="feature">
	<div class="container">
		<div class="title-content center">
			<h2>Fitur Utama Webchat.id</h2>
			<p>Tingkatkan komunikasi dengan pelanggan dengan automasi dan solusi lainnya. Buat broadcast dan kelola pesan WhatsApp jadi lebih mudah</p>
		</div>

		<div class="wrap-feature">
			<?php foreach ($feature as $d): ?>
				<div class="item-feature">
					<div class="icon-feature">
						<?=$d->feature_icon?>
					</div>
					<div class="content-feature">
						<h3><?=$d->feature_name?></h3>
						<p><?=$d->feature_desc?></p>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>