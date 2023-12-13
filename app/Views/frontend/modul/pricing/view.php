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

		<ul class="price-type ul nav">
			<li>
				<a class="active" href="#tab-personal" data-bs-toggle="tab">
					<i class="bi bi-person"></i> Personal
				</a>
			</li>
			<li>
				<a href="#tab-company" data-bs-toggle="tab">
					<i class="bi bi-building"></i> Company
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<?php foreach ($price as $d): ?>
				<?php $active = $d['price']['key'] == 'personal' ? 'show active' : ''; ?>
				<div class="tab-pane fade <?=$active?>" id="tab-<?=$d['price']['key']?>">
					<div class="wrap-box-price">
						<?php foreach ($d['package'] as $p): ?>
							<?php $lists = explode(',', $p->package_desc); ?>
							<div class="box-price">
								<div class="box-price-header">
									<h3><?=$p->package_name?></h3>
								</div>
								<div class="box-price-price">
									<h3><sup>IDR</sup> <?=angka($p->package_price)?> <span>/bulan</span></h3>
								</div>
								<div class="box-price-body">
									<ul>
										<?php foreach ($lists as $key => $value): ?>
											<li><?=$value?></li>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="box-price-footer">
									<!-- <a class="default-btn" href="http://my.webchat.id/register">Register Now</a> -->
									<a class="default-btn" href="<?=site_url('order/package/'.encrypt($p->package_id))?>">Register Now</a>
								</div>
							</div>
						<?php endforeach ?>

						<div class="box-price">
							<div class="box-price-header">
								<h3>Add On</h3>
							</div>
							<div class="box-price-price">
								<h3><sup>IDR</sup> 50,000 - 125,000</h3>
							</div>
							<div class="box-price-body">
								<ul>
									<?php foreach ($d['addon'] as $a): ?>
									<li><?=$a->addon_number?> number + <?=angka($a->addon_message)?> message<br> Rp <?=angka($a->addon_price)?></li>
									<?php endforeach ?>
								</ul>
								<div class="mb-5"></div>
							</div>
							<div class="box-price-footer">
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