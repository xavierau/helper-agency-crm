<form class="white_box_form" action="{{route('search_applicants')}}">
    <div class="form_field">
        <label>{{__("Applicant Number")}}</label>
        <input type="text"
               name="hk_code"
               class="form-control"
               placeholder="{{__("Applicant Number")}}"/>
    </div>
    <div class="form_field">
        <label>{{__("Type")}} </label>
        <input type="text"
               class="form-control"
               placeholder="- {{__("Please Select")}} -"/>
    </div>
    <div class="form_field">
        <label>{{__("Nationality")}} </label>
        <select name="nationality"
                class="form-control">
            <option value="">- {{__("Please Select")}} -</option>
            @foreach($nationalities as $nationality)
                <option value="{{$nationality}}">{{__(ucwords($nationality))}}</option>
            @endforeach

        </select>
    </div>
    <div class="form_field">
        <label>{{__("Religion")}}</label>
        <select name="religion"
                class="form-control">
            <option value="">- {{__("Please Select")}} -</option>
            @foreach($religions as $religion)
                <option value="{{$religion}}">{{__(ucwords($religion))}}</option>
            @endforeach

        </select>
    </div>
    <div class="form_field">
        <label>{{__("Martial Status")}}</label>
        <select name="marital_status"
                class="form-control">
            <option value="">- {{__("Please Select")}} -</option>
            @foreach($marital_statuses as $marital_status)
                <option value="{{$marital_status}}">{{__(ucwords($marital_status))}}</option>
            @endforeach

        </select>
    </div>
    <div class="form_field">
        <label>{{__("Education")}}</label>
        <select name="education"
                class="form-control">
            <option value="">- {{__("Please Select")}} -</option>
            <option value="university">- {{__("University or above")}} -</option>
            <option value="secondary">- {{__("Secondary or above")}} -</option>
            <option value="any">- {{__("Any")}} -</option>

        </select>
    </div>


    <div class="form_field">
        <label>{{__("Weight")}}</label>

        <div class="row" style="width: 100%">
            <div class="col-xs-6">
                <div class="form-group">
                    <input type="number" min="0" step="1" name="min_weight" class="form-control" id="exampleInputEmail1"
                           placeholder="Min Weight">
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <input type="number" min="0" step="1" name="max_weight" class="form-control"
                       id="exampleInputEmail1" placeholder="Min Weight">

            </div>

        </div>
    </div>
    <div class="form_field">
        <label>{{__("Height")}}</label>

        <div class="row" style="width: 100%">

            <div class="col-xs-6">
                <div class="form-group">
                    <input type="number" min="0" step="1" name="min_height" class="form-control"
                           id="exampleInputEmail1" placeholder="Min Height">
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <input type="number" min="0" step="1" name="max_height" class="form-control"
                       id="exampleInputEmail1" placeholder="Min Height">
            </div>

        </div>
    </div>


    <div class="form_field">
        <label>{{__("Overseas Experience")}}</label>
        <div class="three_col_checkbox">
            @foreach($overseas_countries as $country)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="overseas[]"
                               value="{{$country}}">{{__(ucwords($country))}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form_field">
        <label>{{__("Working Scope")}}</label>
        <div class="two_col_checkbox">
            @foreach($duties as $duty)
                <div class="checkbox">
                    <label>
                        <input type="checkbox"
                               name="duties[]"
                               value="{{$duty}}">{{__(ucwords($duty))}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form_field submit_sec">
        <input type="submit" value="{{__("Search")}}"
               class="btn btn-primary"/>
    </div>
</form>
