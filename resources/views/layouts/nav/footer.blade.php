    </div>
    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer_content">
                <div class="footer_main">
                    <div class="footer_links">
                        <p>Company</p>
                        <a href="#">About</a>
                        <a href="#">Our Team</a>
                        <a href="#">Term of Use</a>
                    </div>
                    
                    <div class="footer_links">
                        <p>Product</p>
                        <a href="#">Docs</a>
                        <a href="#">Library</a>
                        <a href="#">MSAL (Javascript)</a>
                        <a href="#">React auths</a>
                        <a href="#">Python auths</a>
                    </div>
    
                    <div class="footer_links">
                        <p>Support</p>
                        <a href="#">Contact</a>
                        <a href="#">Help center</a>
                        <a href="#">FAQ</a>
                    </div>
                </div>

                <div class="footer_newsletter">
                    <a id="site_logo" href="">
                        <img src="{{ asset('images/logo-title.svg') }}">
                    </a>
                    <p>Get the latest updates on our new features and library updates.</p>
                    <div class="footer_form">
                        <form action="{{ route('newsletter.subscribe') }}" id="news_form" method="POST">
                            @csrf
                            <input id="email_field" type="email" name="email" placeholder="Enter email address" required>
                            <button id="subscribe_button" type="submit">Subscribe</button>
                        </form>
                    </div>  
                </div>
            </div>
            <hr>
            <div class="footer_bottom">
                <div class="footer_bottom_links">
                    <a href="">Privacy Policy</a>
                    <a href="">Sitemap</a>
                </div>
                <p>&copy; 2022 Auth-wiki. All rights reserved.</p>
            </div>
        </div>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </footer>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"> </script>
    @stack('js')
    <script type="text/javascript">
    $(document).ready(function(){
        $('#menu_button').click(function(){
            $('#mySidemenu').fadeTo(500, 1).width('322px');
        });
        $('.closebtn').click(function(){
            $('#mySidemenu').fadeTo(500, 0).width('0px');
        });
        $('#show_profile_menu').hover(function(){
            $('#myHovermenu').show();
        }, function(){});
        $('body').click(function(){
            $('#myHovermenu').hide();
        });
        $('#logoutBtn').click(function(){
            $('#logoutForm').submit();
        });
        $('#nav_button').click(function(){
            window.location = '{{ route('register') }}';
        });
    });
    </script>
</body>
</html>
