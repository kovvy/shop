    <script type="text/javascript" src="/js/carousel.js"></script>
    <script type="text/javascript" src="/js/responsiveslides.min.js"></script>

    <script>
        $(function () {
            $("#slider4").responsiveSlides({
                auto: true,
                pager: false,
                nav: true,
                speed: 500,
                namespace: "callbacks"
            });
        });

    </script>

    <div class="margin_l_r-1">

    <section class="baner slider">

        <div class="callbacks_container">
            <ul class="rslides" id="slider4">
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/Termostats_img.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/3-xxodovoy.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/Reflex_Storatherm___ARTHERMO.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/oventrop.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/IBP_center.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/general_fittings.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/banner22.JPG">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
                <li>
                    <a href="">
                        <img src="/images/slider/baner_slider/Kermi_Therm_x2_Line_web.jpg">
                    </a>
                    <p class="caption">This is a caption</p>
                </li>
            </ul>
        </div>
    </section>


    <section class="brands">

        <div class="carousel">
            <div class="prev"><a href="#"></a></div>
            <div class="next"><a href="#"></a></div>
                <div class="carousel-wrapper">
                    <div class="carousel-items">
                        <?php
                            foreach($app -> module -> brand as $brand){
                                echo '
                                        <div class="carousel-block">
                                            <a href="?module=Brands/' .$brand['id'].'">
                                                <img src="/images/slider/brands/' . $brand['img'] . '" alt="' . $brand['title'] . '" />
                                            </a>
                                        </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
        </div>
    </section>


    <ul class="catalog">
        <?php
        $app -> module -> view_catalog($app -> module -> catalog)
        ?>
    </ul>
</div>