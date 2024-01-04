<div class="font-bold">EMPLOYER’S FAMILY INFORMATION (<span
        class="font-normal">僱主家庭成員資料</span>)</div>

<div class="f-12">
    <table class="table-bordered">
        <thead class="text-center">
        <tr>
            <td>Name(姓名)</td>
            <td>Relationship(關係)</td>
            <td>Date of Birth(出生年份)</td>
            <td>HKID Number(身份證號碼)</td>
        </tr>
        </thead>
        <tbody class="text-center">
        @for($i=0;$i<7;$i++)
            @if($i < $contract->residents->count())
                <tr>
                    <td class="text-left">{{$i+1}}
                        / {{optional($contract->residents[$i])->full_name}}</td>
                    <td>{{optional($contract->client->relatives()->where('id',$contract->residents[$i]->id)->first())->pivot->relation}}</td>
                    <td>{{optional(optional($contract->residents[$i])->date_of_birth)->format('d/m/Y')}}</td>
                    <td>{{optional($contract->residents[$i])->hk_id}}</td>
                </tr>
            @else
                <tr>
                <td class="text-left">{{$i+1}}
                    / </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endif
        @endfor
        </tbody>
    </table>

</div>

<div class="f-11">
    Family Member(s) (家庭成員)
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->residents->count()+1}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    person(s)人數,
    Employer’s Residence Area (僱主家居面積):
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->house_size}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    sq.ft.(尺寸),
    Bedrooms (房間)
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->number_of_rooms}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>,

    (
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->number_of_adults}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    ) Adults(成人)

    – Disable person(殘障人仕):
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->disable_personnel ?? 0}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    &lt;constant care(特別照顧)&gt;,
    (
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->number_of_kids ?? 0}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    ) 0-5 Children 小孩,
    <br>
    (
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->number_of_young_adults ?? 0}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    ) 5-18 Children 小孩,
    (
    <span class="text-underline font-bold">
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
        {{$contract->requirement->number_of_expecting_babies ?? 0}}
        <span class="font-for-spaces">
        &nbsp;&nbsp;
        </span>
    </span>
    ) Expecting Babies (預計中嬰兒)


    <table class="">
        <tr>
            <td width="60">Special Duties:</td>
            <td class="input-cell">{{$contract->requirement->special_duties}}</td>
        </tr>
    </table>
</div>
