
<footer class="container-fluid mx-auto">
    <div class="container footer-content">
        <div class="row">
            <div class="col-12 mb-4 mb-md-0">
                <a href="<?= home_url(); ?>"><img class="footer-logo" src="<?= get_template_directory_uri()?>/images/logo-footer.png" alt="logo"></a>
            </div>
        </div>

        <div class="row text-white d-flex justify-content-between align-items-end position-relative">
            <div class="col-12 col-md-5 col-xl-3 ">
                <div>
                    <p class="footer-title">Start a project</p>
                    <p class="footer-text mb-0">We are ready for the challenge</p>
                    <p class="footer-text mt-0">paragon@gmail.com</p>
                </div>
            </div>
            <div class="col-12 col-md-5 col-xl-4">
                <div>
                    <p class="footer-title">Say hello</p>
                    <p class="footer-text mb-0">497 Evergreen Rd. Roseville, CA 95673</p>
                    <p class="footer-text mt-0">+44 345 678 903</p>
                </div>
            </div>
            <div class="col-12 col-md-2 col-xl-5 footer-social">
                <div class="d-flex flex-column justify-content-start align-items-end">
                    <a href="#"><img class="my-2" src="<?= get_template_directory_uri()?>/images/linkedin.png" alt="linkedin"></a>
                    <a href="#"><img class="my-2" src="<?= get_template_directory_uri()?>/images/facebook.svg" alt="facebook"></a>
                    <a href="#"><img class="my-2" src="<?= get_template_directory_uri()?>/images/instagram.svg" alt="instagram"></a>
                </div>
            </div>
        </div>

    </div>
</footer>

<div class="modal-black d-none"></div>
<div class="modal-black-menu d-none"></div>

<?= wp_footer(); ?>

<?php
if(is_page('contact') || is_front_page() || is_singular('property')){
    show_map();
    echo '<script src="'.get_template_directory_uri().'/js/map-additionals.js"></script>';
}
?>

</body>
</html>