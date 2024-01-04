@extends('layouts.default')

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 p_sm_o">
                        <div class="owl-carousel" id="banner">

                            <div class="item">
                                @if($link = $page->getContent('banner_1_link', null, app()->getLocale()))
                                    <a href="{{$link}}"><img src="{{ $page->getContent('banner_1')}}"/></a>
                                @else
                                    <img src="{{$page->getContent('banner_1')}}"/>
                                @endif
                            </div>


                            @for($i=1; $i<=5; $i++)
                                @if($banner = $page->getContent('banner_'.$i, null, app()->getLocale()))
                                    <div class="item">
                                        @if($link = $page->getContent('banner_'.$i.'_link', null, app()->getLocale()))
                                            <a href="{{$link}}"><img src="{{$banner}}"/></a>
                                        @else
                                            <img src="{{$banner}}"/>
                                        @endif
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        @include('_partials.icon_menu')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row m_t_50 m_b_50">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                @include('_partials.search_applicant')
                            </div>
                            <div class="col-md-4  col-sm-6 col-xs-12">
                                <x-featured_applicants :number="8"/>
                                <a href="#" class="find_employee mobile_show">
                                    <img src="/images/find_employee.png"
                                         class="center-block"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
