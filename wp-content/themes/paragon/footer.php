<?php
global $linkedin_link;
global $instagram_link;
?>
<footer class="container-fluid mx-auto">
    <div class="container footer-content">
        <div class="row">
            <div class="col-12 mb-4 mb-md-0">
                <a href="<?= home_url(); ?>"><img class="footer-logo"
                                                  src="<?= get_template_directory_uri() ?>/images/logo-footer.png"
                                                  alt="logo"></a>
            </div>
        </div>

        <div class="row text-white d-flex justify-content-between align-items-end position-relative">
            <div class="col-12 col-md-5 col-xl-3 ">
                <div>
                    <p class="footer-title">Start An Avaluation</p>
                    <p class="footer-text mb-0">We are ready for the challenge</p>
                    <p class="footer-text mt-0 mb-0"><a class="text-white text-xs" href="mailto:Info@PadagonREA.com">Info@PadagonREA.com</a> </p>
                    <p class="footer-text mt-0"><a class=" text-xs text-white" href="/">PadagonREA.com</a></p>


                </div>
            </div>
            <div class="col-12 col-md-5 col-xl-4">
                <div>
                    <p class="footer-title">Visit US</p>
                    <p class="footer-text mb-0">600 University St, Suite 2018. Seattle, WA 98101</p>
                    <p class="footer-text mt-0 mb-0"><a class="text-white text-xs" href="tel:206-623-8880">P 206-623-8880</a>
                    </p>
                    <p class="footer-text mt-0"><a class="text-white text-xs" href="tel:206-623-7435">F 206-623-7435</a>
                    </p>

                </div>
            </div>
            <div class="col-12 col-md-2 col-xl-5 footer-social">
                <div class="d-flex flex-column justify-content-start align-items-end">
                    <a target="_blank" href="<?php echo $linkedin_link;?>"><img class="my-2" src="<?= get_template_directory_uri() ?>/images/linkedin.png"
                                     alt="linkedin"></a>

                    <a  target="_blank" href="<?php echo $instagram_link;?>"><img class="my-2" src="<?= get_template_directory_uri() ?>/images/instagram.svg"
                                     alt="instagram"></a>
                </div>
            </div>
        </div>

    </div>
</footer>

<div class="modal-black d-none"></div>
<div class="modal-black-menu d-none"></div>

<?= wp_footer(); ?>

<?php
if (is_page('contact') || is_front_page() || is_singular('property')) {
    show_map();
    echo '<script src="' . get_template_directory_uri() . '/js/map-additionals.js"></script>';
}
//if(is_page('contact')){
//    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
//}
?>

</body>
</html>