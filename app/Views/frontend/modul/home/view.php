<div id="banner">
	<div class="bg-banner"></div>
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6">
				<div class="img-banner">
					<img class="img" src="<?=base_url('public/images/chat-illustration.png')?>" alt="">
				</div>
			</div>

			<div class="col-md-5">
				<div class="content-banner">
					<!-- <h2>Build your brand connecting with customers</h2> -->
					<h2>Kirim pesan ke banyak nomor dengan mudah tinggal klik</h2>
					<p>Mengirim pesan broadcast jadi lebih mudah dan kelola pesan berdasarkan kontak dengan admin pengguna tertentu, pesan jadi lebih private, serta fitur auto reply memberikan respon cepat kepada customer anda.</p>
					<a class="default-btn btn-banner" href="http://my.webchat.id/register">Register now <i class="bi bi-arrow-right"></i></a>
					<a class="default-btn only-border btn-banner-border" href="#"><i class="bi bi-fire"></i> Start Free Trial</a>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="feature">
	<div class="container">
		<div class="title-content center">
			<h2>Fitur Webchat.id</h2>
			<p>Beragam fitur yang memudahkan dalam berkomunikasi dengan customer anda.</p>
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

<section id="pricing">
	<div class="container">
		<div class="title-content center">
			<h2>Pricing Plan</h2>
			<p>Sesuaikan dengan kebutuhan yang anda perlukan</p>
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

<section id="video">
	<div class="container">
		<div class="title-content center">
			<h2>Watch this Video</h2>
			<p>Tonton video dibawah ini untuk lebih lengkapnya, bagaimana cara penggunaan webchat.id</p>
		</div>

		<div class="content-video">
			<a class="img-video" href="#">
				<span class="shape-video"></span>
				<img src="<?=base_url('public/images/video-bg.jpg')?>" alt="">
				<span class="button-play">
					<i class="bi bi-play-fill"></i>
				</span>
			</a>
		</div>

		<div class="contact-video">
			<div class="content-contact-video">
				<h3>Have any question about us?</h3>
				<p>Don't hesitate to contact us.</p>
			</div>
			<div class="button-contact-video">
				<a class="default-btn" href="#"><i class="bi bi-telephone"></i> Contact Us</a>
			</div>
		</div>
	</div>
</section>