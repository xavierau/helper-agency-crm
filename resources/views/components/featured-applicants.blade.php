<div class="white_box featured-applicants">
    <div class="white_box_ribbion">
        {{__("Featured")}}
    </div>

    <div class="row image_section">
        @foreach($applicants as $applicant)
            <div class="col-xs-6">
                @include('_partials.featured_applicant_item',['$applicant'=>$applicant])
            </div>
        @endforeach
    </div>
</div>
