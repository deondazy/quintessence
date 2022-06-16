<?php

if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$file     = 'gallery/';
$pageName = 'Gallery';

include __DIR__ . '/header.php';
?>

<div class="col-md-12">
    <!-- Image grid -->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/1.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/1.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/2.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/2.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/3.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/3.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/4.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/4.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/5.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/5.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/6.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/6.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/7.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/7.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/8.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/8.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/9.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/9.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/10.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/10.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                <div class="thumb">
                    <img src="<?php echo $site->url; ?>/images/instagram/11.jpg" alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="<?php echo $site->url; ?>/images/instagram/11.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /image grid -->
</div>
<?php include __DIR__ . '/footer.php'; ?>
<script src="<?php echo $site->url; ?>/dashboard/global_assets/js/plugins/media/fancybox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    });
</script>
