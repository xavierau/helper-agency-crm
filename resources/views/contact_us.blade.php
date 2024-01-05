@extends('layouts.default')

@push('style')
    <style>
        section.message {
            padding: 15px
        }
    </style>
@endpush

@section('content')
    <section class="container-fluid sub_banner"
             style="background: url({{$page->getContent('banner')}}) center center / cover no-repeat">
        <div class="row" style="background: rgba(0,0,0,0.6)">
            <div class="container">
                <div class="row m_t_90 m_b_90">
                    <div class="col-md-12 text-center">
                        <h2>{{__("Contact Us")}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(session()->has('message'))
        <section class="message bg-primary p-5 text-center">
            <h3>{{session()->get('message')}}</h3>
        </section>
    @endif

    <section class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row m_t_50 m_b_50">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="white_box">
                                    <div class="white_box_ribbion">
                                        {{__("Locations")}}
                                    </div>

                                    @if($page->getContent('shop_1'))
                                        <div class="phone_box">
                                            <h3>{{$page->getContent('shop_1','荃灣(總店)')}} </h3>

                                            <div class="info">
                                                <img src="images/location.png"
                                                     class="img-responsive">
                                                <span>{{$page->getContent('shop_1_address','新界 荃灣 青山公路 264-298 號 南豐中心1231室')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/phone.png" class="img-responsive">
                                                <span>{{__("Tel")}} : {{$page->getContent('shop_1_tel','2331-3111')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/p-book.png" class="img-responsive">
                                                <span>{{__("Fax")}} : {{$page->getContent('shop_1_fax','3747-5225')}}</span>
                                            </div>

                                            <div class="info">
                                                <img src="images/w-app.png" class="img-responsive">
                                                <span>Whatsapp : {{$page->getContent('shop_1_whatsapp','wbc')}}</span>
                                            </div>

                                            <div class="row flex_col map_data">
                                                <div
                                                    class="col-md-8 col-sm-6 col-xs-7 flex_col p_r">
                                                    {{embed_google_map('embed?pb=!1m18!1m12!1m3!1d56593509.36396439!2d67.4692816011634!3d30.03130070479193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31508e64e5c642c1%3A0x951daa7c349f366f!2sChina!5e0!3m2!1sen!2sin!4v1623883649463!5m2!1sen!2sin')}}
                                                </div>
                                                <div
                                                    class="col-md-4 col-sm-6 col-xs-5 flex_col p_l">
                                                    <img
                                                        src="{{$page->getContent('shop_1_pic','images/placeholder.png')}} "
                                                        class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($page->getContent('shop_2'))
                                        <div class="phone_box">
                                            <h3>{{$page->getContent('shop_2','荃灣(總店)')}} </h3>

                                            <div class="info">
                                                <img src="images/location.png"
                                                     class="img-responsive">
                                                <span>{{$page->getContent('shop_2_address','新界 荃灣 青山公路 264-298 號 南豐中心1231室')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/phone.png" class="img-responsive">
                                                <span>電話 : {{$page->getContent('shop_2_tel','2331-3111')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/p-book.png" class="img-responsive">
                                                <span>傳真 : {{$page->getContent('shop_2_fax','3747-5225')}}</span>
                                            </div>

                                            <div class="info">
                                                <img src="images/w-app.png" class="img-responsive">
                                                <span>Whatsapp : {{$page->getContent('shop_2_whatsapp','wbc')}}</span>
                                            </div>

                                            <div class="row flex_col map_data">
                                                <div
                                                    class="col-md-8 col-sm-6 col-xs-7 flex_col p_r">
                                                    {{embed_google_map('embed?pb=!1m18!1m12!1m3!1d56593509.36396439!2d67.4692816011634!3d30.03130070479193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31508e64e5c642c1%3A0x951daa7c349f366f!2sChina!5e0!3m2!1sen!2sin!4v1623883649463!5m2!1sen!2sin')}}
                                                </div>
                                                <div
                                                    class="col-md-4 col-sm-6 col-xs-5 flex_col p_l">
                                                    <img
                                                        src="{{$page->getContent('shop_2_pic','images/placeholder.png')}} "
                                                        class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($page->getContent('shop_3'))
                                        <div class="phone_box">
                                            <h3>{{$page->getContent('shop_3','荃灣(總店)')}} </h3>

                                            <div class="info">
                                                <img src="images/location.png"
                                                     class="img-responsive">
                                                <span>{{$page->getContent('shop_3_address','新界 荃灣 青山公路 264-298 號 南豐中心1231室')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/phone.png" class="img-responsive">
                                                <span>電話 : {{$page->getContent('shop_3_tel','2331-3111')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/p-book.png" class="img-responsive">
                                                <span>傳真 : {{$page->getContent('shop_3_fax','3747-5225')}}</span>
                                            </div>

                                            <div class="info">
                                                <img src="images/w-app.png" class="img-responsive">
                                                <span>Whatsapp : {{$page->getContent('shop_3_whatsapp','wbc')}}</span>
                                            </div>

                                            <div class="row flex_col map_data">
                                                <div
                                                    class="col-md-8 col-sm-6 col-xs-7 flex_col p_r">
                                                    {{embed_google_map('embed?pb=!1m18!1m12!1m3!1d56593509.36396439!2d67.4692816011634!3d30.03130070479193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31508e64e5c642c1%3A0x951daa7c349f366f!2sChina!5e0!3m2!1sen!2sin!4v1623883649463!5m2!1sen!2sin')}}
                                                </div>
                                                <div
                                                    class="col-md-4 col-sm-6 col-xs-5 flex_col p_l">
                                                    <img
                                                        src="{{$page->getContent('shop_3_pic','images/placeholder.png')}} "
                                                        class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($page->getContent('shop_4'))
                                        <div class="phone_box">
                                            <h3>{{$page->getContent('shop_4','荃灣(總店)')}} </h3>

                                            <div class="info">
                                                <img src="images/location.png"
                                                     class="img-responsive">
                                                <span>{{$page->getContent('shop_4_address','新界 荃灣 青山公路 264-298 號 南豐中心1231室')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/phone.png" class="img-responsive">
                                                <span>電話 : {{$page->getContent('shop_4_tel','2331-3111')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/p-book.png" class="img-responsive">
                                                <span>傳真 : {{$page->getContent('shop_4_fax','3747-5225')}}</span>
                                            </div>

                                            <div class="info">
                                                <img src="images/w-app.png" class="img-responsive">
                                                <span>Whatsapp : {{$page->getContent('shop_4_whatsapp','wbc')}}</span>
                                            </div>

                                            <div class="row flex_col map_data">
                                                <div
                                                    class="col-md-8 col-sm-6 col-xs-7 flex_col p_r">
                                                    {{embed_google_map('embed?pb=!1m18!1m12!1m3!1d56593509.36396439!2d67.4692816011634!3d30.03130070479193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31508e64e5c642c1%3A0x951daa7c349f366f!2sChina!5e0!3m2!1sen!2sin!4v1623883649463!5m2!1sen!2sin')}}
                                                </div>
                                                <div
                                                    class="col-md-4 col-sm-6 col-xs-5 flex_col p_l">
                                                    <img
                                                        src="{{$page->getContent('shop_4_pic','images/placeholder.png')}} "
                                                        class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($page->getContent('shop_5'))
                                        <div class="phone_box">
                                            <h3>{{$page->getContent('shop_5','荃灣(總店)')}} </h3>

                                            <div class="info">
                                                <img src="images/location.png"
                                                     class="img-responsive">
                                                <span>{{$page->getContent('shop_5_address','新界 荃灣 青山公路 264-298 號 南豐中心1231室')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/phone.png" class="img-responsive">
                                                <span>電話 : {{$page->getContent('shop_5_tel','2331-3111')}} </span>
                                            </div>

                                            <div class="info">
                                                <img src="images/p-book.png" class="img-responsive">
                                                <span>傳真 : {{$page->getContent('shop_5_fax','3747-5225')}}</span>
                                            </div>

                                            <div class="info">
                                                <img src="images/w-app.png" class="img-responsive">
                                                <span>Whatsapp : {{$page->getContent('shop_5_whatsapp','wbc')}}</span>
                                            </div>

                                            <div class="row flex_col map_data">
                                                <div
                                                    class="col-md-8 col-sm-6 col-xs-7 flex_col p_r">
                                                    {{embed_google_map('embed?pb=!1m18!1m12!1m3!1d56593509.36396439!2d67.4692816011634!3d30.03130070479193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31508e64e5c642c1%3A0x951daa7c349f366f!2sChina!5e0!3m2!1sen!2sin!4v1623883649463!5m2!1sen!2sin')}}
                                                </div>
                                                <div
                                                    class="col-md-4 col-sm-6 col-xs-5 flex_col p_l">
                                                    <img
                                                        src="{{$page->getContent('shop_5_pic','images/placeholder.png')}} "
                                                        class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="bottom_filds">
                                                <form method="POST" action="/contact_us">
                                                    @csrf
                                                    <div class="white_box_ribbion">
                                                        {{__("Featured")}}
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Name")}}</label>
                                                        <input type="text"
                                                               name="name"
                                                               class="form-control"
                                                               placeholder=""/>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Contact Number")}}</label>
                                                        <input type="text"
                                                               name="tel"
                                                               class="form-control"
                                                               placeholder=""/>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Email")}}</label>
                                                        <input type="email"
                                                               name="email"
                                                               class="form-control"
                                                               placeholder=""/>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Message")}}</label>
                                                        <textarea name="message"
                                                                  class="form-control"
                                                                  placeholder=""
                                                                  rows="2"></textarea>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Martial Status")}}</label>
                                                        <select class="form-control"
                                                                name="marital_status">
                                                            <option value=""> - {{__("Please Select")}} -</option>
                                                            <option
                                                                value="single">{{__("Single")}}
                                                            </option>
                                                            <option
                                                                value="married">{{__("Married")}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form_field submit_sec">
                                                        <input type="submit"
                                                               value="傳送"
                                                               class="btn btn-primary"/>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
