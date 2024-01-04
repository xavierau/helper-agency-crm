@extends('layouts.default')

@section('content')
    <section class="container-fluid sub_banner"
             style="background: url({{$page->getContent('banner')}}) center center / cover no-repeat">
        <div class="row" style="background: rgba(0,0,0,0.6)">
            <div class="container">
                <div class="row m_t_90 m_b_90">
                    <div class="col-md-12 text-center">
                        <h2>{{__("Search Applicants")}}</h2>
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
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <x-featured-applicants/>
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
