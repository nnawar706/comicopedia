    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ route('welcome') }}">
                                <img src="{{ asset('uploads/general/1687025780980.png') }}" height="40" width="60" alt="site-logo">
                            </a>
                        </div>
                        <ul>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form method="post" action="{{ route('subscribe') }}">
                            @csrf
                            <input type="email" name="email" placeholder="Your Email" required>
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                            MangaMania &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Designed and Developed by <a style="color:#101f56; font-weight:bold" href="https://colorlib.com" target="_blank">CodeArc</a>
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="{{ asset('uploads/general/1687029130912.png') }}" alt="payment-gateways"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
