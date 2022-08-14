    </div>
    <!-- FOOTER -->
    <footer>
        <div class="be_container">
            <div class="footer_content">
                <div class="footer_main">
                    <div class="footer_links">
                        <p>Company</p>
                        <a href="{{ route('page.about') }}">About</a>
                        <a href="{{ route('page.about') }}#be_team">Our Team</a>
                        <a href="{{ route('page.tos') }}">Term of Use</a>
                    </div>
                    <div class="footer_links">
                        <p>Product</p>
                        <a href="{{ route('page.documentation') }}">Docs</a>
                        <a href="{{ route('page.library') }}">Library</a>
                        <a href="{{ route('page.library') }}?stack=javascript">Javascript</a>
                        <a href="{{ route('page.library') }}?stack=django">Django (Python)</a>
                        <a href="{{ route('page.library') }}?stack=python">Python auths</a>
                    </div>
                    <div class="footer_links">
                        <p>Support</p>
                        <a href="mailto:{{ env('APP_MAIL', 'info@authwiki.herokuapp.com') }}">Contact</a>
                        <a href="{{ route('page.documentation') }}#usage">Help center</a>
                        <a href="{{ route('page.documentation') }}#faqs">FAQ</a>
                    </div>
                </div>
                <div class="footer_newsletter">
                    <img id="site_logo" src="{{ asset('images/logo-title.svg') }}">
                    <p>Get the latest updates on our new features and library updates.</p>
                    <div class="footer_form">
                        <form action="{{ route('newsletter.subscribe') }}" id="news_form" method="POST">
                            @csrf
                            <input id="email_field" type="email" name="email" placeholder="Enter email address">
                            <button id="subscribe_button" type="submit" disabled>Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="footer_bottom">
                <div class="footer_bottom_links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Sitemap</a>
                </div>
                <p>&copy; 2022 Auth-wiki. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"> </script>
    <script src="{{ asset('js/toastr.min.js') }}"> </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        });
        $(document).ready(function(){
            // function search() {
            //      var name = document.getElementById("searchForm").elements["searchItem"].value;
            //     var pattern = name.toLowerCase();
            //     var targetId = "";

            //     var divs = document.getElementsByClassName("col-md-2");
            //     for (var i = 0; i < divs.length; i++) {
            //         var para = divs[i].getElementsByTagName("p");
            //         var index = para[0].innerText.toLowerCase().indexOf(pattern);
            //         if (index != -1) {
            //         targetId = divs[i].parentNode.id;
            //         document.getElementById(targetId).scrollIntoView();
            //         break;
            //         }
            //     }
            // }
            $('form#news_form input[type=email]').on('keyup', function(){
                let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(regex.test($(this).val())){
                    $(this).siblings('button').removeAttr('disabled').addClass('active');
                } else {
                    $(this).siblings('button').attr('disabled', true).removeClass('active');
                }
            });
            $('#menu_button').click(function(){
                let w = '322px', width = $(window).outerWidth();
                if(width < 768) {
                    w = (width * 0.8) + 'px';
                }
                $('#mySidemenu').css({
                    'padding-left': '32px',
                    'box-shadow': '0px 0px 100px 100vw  rgba(0, 0, 0, 0.2), 0px 4px 100px 20px rgba(0, 0, 0, 0.2)',
                    'width': w
                });
            });
            $('.closebtn').click(function(){
                $('#mySidemenu').css({
                    'padding-left': '0px',
                    'box-shadow': 'none',
                    'width': '0px'
                });
            });
            $('#be_menu').mouseenter(function(){
                $('#myHovermenu').addClass('d-flex');
            });
            $('body').click(function(e){
                if($('#mySidemenu').width() > 0 && !($(e.target).parents('#mySidemenu').length > 0 || e.target.id == 'mySidemenu'|| e.target.id == 'menu_button')) {
                    $('.closebtn').trigger('click');
                }
                if($('#myHovermenu').hasClass('d-flex') && !($(e.target).parents('#myHovermenu').length > 0 || e.target.id == 'myHovermenu' || e.target.id == 'be_menu')) {
                    $('#myHovermenu').removeClass('d-flex');
                }
                if(!$('.search_result').hasClass('d-none') && $(e.target).parents('.input-box').length == 0) {
                    $('.search_result').addClass('d-none');
                }
            });
            $('a#logoutBtn').click(function(){
                $.ajax({
                    url: '{{ route('logout') }}',
                    method: 'POST'
                })
                .done(function(){
                    window.location = '{{ route('index') }}';
                });
            });
            $('[data-href]').click(function(){
                let _action = $(this).attr('data-action');
                if(typeof _action !== 'undefined' && _action !== false) {
                    $.ajax({
                        url: $(this).data('action'),
                        method: 'POST',
                        success: function() {
                            window.location = $(this).data('href');
                        }
                    });
                } else {
                    window.location = $(this).data('href');
                }
            });
            $('[data-target]').click(function(){
                let item = $('#'+$(this).data('target')).offset();
                $('html, body').animate({
                    scrollTop: (item.top - 110),
                    scrollLeft: (item.left - 10)
                }, 2000);
                let _action = $(this).attr('data-value');
                if(typeof _action !== 'undefined' && _action !== false) {
                    $('#'+$(this).data('target')).val('@'+$(this).data('value')+': ');
                }
            });
            $("header a:not(.site_logo a), #mySidemenu a:not(.closebtn)").each(function() {
                if($(this).attr('href') === window.location.href) {
                    $(this).addClass("active");
                }
            });
            @if($errors->any())
                @foreach($errors->all() as $message)
                toastr.error('{{ $message }}');
                @endforeach
            @endif
            @if(session('success'))
            toastr.success('{{ session('success') }}');
            @endif
            @if(session('error'))
            toastr.error('{{ session('error') }}');
            @endif
            @if(session('warning'))
            toastr.warning('{{ session('warning') }}');
            @endif
        });
    </script>
    @stack('js')
</body>
</html>
