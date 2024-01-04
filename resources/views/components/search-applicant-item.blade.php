<div class="{{$class}}">
    <div class="my">
        <div class="s-icon">
            <table>
                <tr>
                    <td>
                        <a href="#" type="button" class="video-btn"
                           data-toggle="modal"
                           data-src="https://www.youtube.com/embed/orbkg5JH9C8"
                           data-target="#myModal"/>
                        <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                        <div class="modal fade" id="myModal"
                             tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                        <span
                            aria-hidden="true">&times;</span>
                                        </button>
                                        <div
                                            class="embed-responsive embed-responsive-16by9">
                                            <iframe
                                                class="embed-responsive-item"
                                                src="" id="video"
                                                allowscriptaccess="always"
                                                allow="autoplay"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </td>
                    <td>
                        <a href="/core/applicants/profile/{{$applicant->hash}}">
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    </td>
                    <td>
                        <form action="{{route("cart.store", $applicant->id)}}"
                              class="d-inline"
                              method="POST">
                            @csrf
                            <button type="submit" style="border:none; background-color:transparent; ">
                                @if(in_cart($applicant->hk_code))
                                    <i class="fa fa-heart" aria-hidden="true" style="color:red"></i>
                                @else
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                @endif
                                {{-- <img src="/images/w5.png" class="img-responsive"/> --}}
                            </button>
                        </form>
                    </td>
                </tr>
            </table>


        </div>
        <div class="s-number">
            <p>{{$applicant->hk_code}}</p>
        </div>
    </div>
    <div class="box_details">
        <a href="{{$applicant->thumbnail??"/images/placeholder.png"}}"
           data-lightbox="applicant_{{$applicant->hk_code}}_images"><img
                src="{{$applicant->thumbnail??"/images/placeholder.png"}}"
                class="img-responsive center-block" style="min-height:300px"></a>
{{--        <p><span>{{__("HK Code")}}: {{ $applicant->hk_code}} </span>--}}
{{--        </p>--}}
        <p><span>{{__("Nationality")}}: {{__(ucwords($applicant->nationality))}} </span>
            <span>{{__("Marital Status")}}: {{__(ucwords($applicant->marital_status))}} </span></p>
        <p><span>{{__("Education")}}: {{__(ucwords($applicant->highest_education))}}</span>
            <span>{{__("Religion")}}: {{__(ucwords($applicant->religion))}}</span></p>
        <p>
            <span>{{__("Age")}}: {{$applicant->age}}</span>
            <span>{{__("Zodiac")}}: {{__(ucwords($applicant->chinese_zodiac))}}</span>
{{--            <span>{{__("Supplier")}}: {{$applicant->supplier?->code}}</span>--}}
        </p>
        <p>
            <span>{{__("Height")}}: {{$applicant->height}}cm</span>
            <span>{{__("Weight")}}: {{$applicant->weight}}KG</span>
        </p>
        <p>
            <span>{{__("Eat Pork")}}: @if($applicant->questions->eat_pork) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-xmark"></i> @endif </span>
            <span>{{__("Afraid of dog")}}: @if($applicant->questions->afraid_of_dog) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-xmark"></i> @endif </span>
        </p>
        <p>
            <span>{{__("Overseas Experience")}}: {{$applicant->experiences->sortBy('location')->map(fn($i)=>__(ucwords($i->location)))->unique()->implode(', ')}}</span>
        </p>
        <p><span>{{__("Experience")}}: {{$applicant->all_duties->join(', ')}} </span></p>
    </div>
</div>
