<div class="{{$class??"row image_section m_t_20" }}">
    <div class="row image_section m_t_20">
        @foreach($selected_applicants as $item)
        <x-search-applicant-item
            class="col-sm-6 col-xs-12"
            :applicant="$item"/>
        @endforeach
    </div>

</div>
