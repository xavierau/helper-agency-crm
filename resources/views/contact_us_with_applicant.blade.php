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
                        <h2>{{__("聯絡我們")}}</h2>
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
                            <div>
                                <div class="white_box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-selected_applicants />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="{{route('applicants_enquiry')}}">
                                                @csrf
                                                <div class="form_mobile">
                                                    <div class="form_field">
                                                        <label>{{__("Customer Name")}} <sup>*</sup></label>
                                                        <input type="text"
                                                        class="form-control"
                                                        placeholder="Customer Name"
                                                        required/>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Contact Number")}} <sup>*</sup></label>
                                                        <input type="text"
                                                        class="form-control"
                                                        placeholder="Contact Number"
                                                        required/>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Fax")}} </label>
                                                        <input type="text"
                                                        class="form-control"
                                                        placeholder="Fax" />
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Email")}} <sup>*</sup></label>
                                                        <input type="text"
                                                        class="form-control"
                                                        placeholder="Email"
                                                        required/>
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Expected arrival date")}}  <sup>*</sup></label>
                                                        <input type="text"
                                                        class="form-control"
                                                        placeholder="Expected arrival date"
                                                        required
                                                        />
                                                    </div>
                                                    <div class="form_field">
                                                        <label>{{__("Note")}}</label>
                                                        <textarea type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Note"
                                                                                    rows="2"></textarea>
                                                    </div>
                                                    <div class="form_field place_color">
                                                        <label>{{__("Branch")}} <sup>*</sup></label>
                                                        <select type="text" class="form-control" required>
                                                            <option value="">- {{__("請選擇")}} -</option>
                                                            <option value="Tsuen Wan"> {{__("Tsuen Wan")}} </option>
                                                        </select>
                                                    </div>
                                                    <div class="form_field">
                                                        <label></label>
                                                        <p><sup>*</sup> 輸入資料</p>
                                                    </div>

                                                    <div class="form_field submit_sec">
                                                        <input type="submit"
                                                        value="傳送"
                                                        class="btn btn-primary"
                                                        />
                                                    </div>
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
    </section>


@endsection
