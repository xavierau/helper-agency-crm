@extends('layouts.default')

@section('content')
    <section class="container-fluid sub_banner"
             style="background: url('images/banner.png') center center / cover no-repeat">
        <div class="row" style="background: rgba(0,0,0,0.6)">
            <div class="container">
                <div class="row m_t_90 m_b_90">
                    <div class="col-md-12 text-center">
                        <h2>{{__("Selected Applicants")}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    <button type="button" class="btn btn-primary video-btn" data-toggle="modal"--}}
{{--            data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-target="#myModal">--}}
{{--        Play Video 1 - autoplay--}}
{{--    </button>--}}
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                                allow="autoplay"></iframe>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <section class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row m_t_50 m_b_50">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <x-selected_applicants />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
