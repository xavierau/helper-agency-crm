<header class="container-fluid">
    <div class="row preheader">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 text-right">
                    <span class="language">
                        <a href="@if(app()->getLocale()==='en') /setLocale/zh @else /setLocale/en @endif"> @if(app()->getLocale()==='en')
                                中文
                            @else
                                English
                            @endif
                        </a>
                    </span>
                    <a href="#" class="whatsapp">
                        <img src="/images/whatsapp.png">
                        <p>CALL {{common_content('contact_number')}} </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container  ">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img src="/images/logo.svg">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right"
                     id="bs-example-navbar-collapse-1">
                    <a href="#" class="find_employee desktop_show"><img
                            src="/images/find_employee.png"></a>
                    @include('_partials.navbar')


                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</header>
