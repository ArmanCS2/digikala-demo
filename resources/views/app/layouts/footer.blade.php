<!-- start footer -->
<footer class="footer">
    <section class="container-xxl my-4">
        <section class="row">
            <section class="col">
                <section class="footer-shop-features d-md-flex justify-content-md-around align-items-md-center">

                    <section class="footer-shop-features-item">
                        <img src="{{asset('app-assets/images/footer/1.png')}}" alt="">
                        <section class="text-center">امکان تحویل اکسپرس</section>
                    </section>

                    <section class="footer-shop-features-item">
                        <img src="{{asset('app-assets/images/footer/2.png')}}" alt="">
                        <section class="text-center">پرداخت به صورت آنی</section>
                    </section>

                    <section class="footer-shop-features-item">
                        <img src="{{asset('app-assets/images/footer/3.png')}}" alt="">
                        <section class="text-center">7 روز هفته، 24 ساعته</section>
                    </section>

                    <section class="footer-shop-features-item">
                        <img src="{{asset('app-assets/images/footer/4.png')}}" alt="">
                        <section class="text-center">10 روز ضمانت بازگشت کالا</section>
                    </section>

                    <section class="footer-shop-features-item">
                        <img src="{{asset('app-assets/images/footer/5.png')}}" alt="">
                        <section class="text-center">ضمانت کیفیت کالا</section>
                    </section>

                </section>
            </section>
        </section>
        <section class="row d-flex justify-content-between">

            @foreach($footers as $footer)
                <section class="col-sm-12 col-md-3">
                    @foreach($footer->subFooters as $subFooter)
                        <section><a class="text-decoration-none text-muted d-inline-block my-2"
                                    href="{{url($subFooter->link)}}">{{$subFooter->title}}</a>
                        </section>
                    @endforeach
                </section>
            @endforeach


            <section class="col-md-3">
                {!! $setting->link_6 !!}
            </section>


            <section class="col-md-3">
                <section>
                    <section class="text-dark fw-bold">با ما همراه باشید</section>
                    <section class="my-3">
                        <a href="{{$setting->instagram}}"
                           class="text-muted text-decoration-none me-5" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{$setting->telegram}}"
                           class="text-muted text-decoration-none me-5" target="_blank"><i
                                class="fab fa-telegram"></i></a>
                        <a href="{{$setting->link_1}}"
                           class="text-muted text-decoration-none me-5" target="_blank"><i
                                class="fa fa-play"></i></a>
                        <a href="{{$setting->link_2}}"
                           class="text-muted text-decoration-none me-5" target="_blank"><i
                                class="fa fa-x"></i></a>
                        <a href="{{$setting->my_site}}"
                           class="text-muted text-decoration-none me-5" target="_blank"><i
                                class="fa fa-link"></i></a>
                    </section>
                </section>
            </section>

        </section>
        <section class="row my-5">
            <section class="col">
                <section class="fw-bold">درباره فروشگاه</section>
                <section class="text-muted footer-intro">
                    {{$setting->description}}
                    <br>
                    راه های ارتباطی :

                    تلگرام : <a href="{{$setting->telegram}}"
                                class="text-muted text-decoration-none me-5"><i
                            class="fab fa-telegram"></i></a>

                    اینستاگرام : <a href="{{$setting->instagram}}"
                                    class="text-muted text-decoration-none me-5"><i
                            class="fab fa-instagram"></i></a>

                    پشتیبانی : <a href="tel:{{$setting->tel}}"
                                  class="text-dark">{{$setting->tel}}</a>

                </section>
            </section>
        </section>

        <section class="row border-top pt-4">
            <section class="col">
                <section class="text-muted footer-intro text-center">
                    کلیه حقوق وبسایت محفوظ است
                </section>
            </section>
        </section>
    </section>
</footer>
<!-- end footer -->
