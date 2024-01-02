<header>
    <div class="container">
        <div class="navbar-header">
            <div class="toggle-menu">
                <span></span>
            </div>
            
            <a class="logo" href="<?=site_url()?>">
                <img src="<?=base_url('public/images/logo-webchat.png')?>" alt="">
            </a>
            
            <div id="menu">
                <div class="top-menu-mobile">
                    <h3>Menu</h3>
                    <span id="close-menu"><i class="bi bi-x-lg"></i></span>
                </div>
                
                <ul class="ul">
                    <li><a href="<?=site_url()?>">Home</a></li>
                    <li><a href="<?=site_url('about')?>">About Us</a></li>
                    <li><a href="<?=site_url('pricing')?>">Pricing</a></li>
                    <li><a href="<?=site_url('use-case')?>">Use Case</a></li>
                    <li><a href="<?=site_url('contact')?>">Contact Us</a></li>
                </ul>
            </div>

            <div id="button-header">
                <ul class="ul">
                    <li>
                        <a class="default-btn" href="http://my.webchat.id"><i class="bi bi-box-arrow-in-right"></i> <span>Log In</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>