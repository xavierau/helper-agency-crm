<div class="font-bold">Employer’s Accommodation and official day off Arrangement (<span
        class="font-normal">傭工住宿及假期安排</span>)
</div>

<div class="f-11" style="vertical-align:bottom">
    Accommodation 住宿安排:
    <input type="checkbox"
           @if($contract->requirement->accommodation_type === 'alone') checked @endif />
    <span class="text-underline font-bold">
        <span class="font-for-spaces"></span>
        @if($contract->requirement->accommodation_type === 'alone') {{$contract->requirement->accommodation_value}} @endif
        <span class="font-for-spaces"></span>
    </span>
    sq.f t.
    Own room 獨立房 /
    <input type="checkbox"
           @if($contract->requirement->accommodation_type === 'shared') checked @endif />
    Share room with(同房) *
    <span class="text-underline font-bold">
        <span class="font-for-spaces"></span>
        @if($contract->requirement->accommodation_type === 'shared') {{$contract->requirement->accommodation_value}} @endif
        <span class="font-for-spaces"></span>
    </span>

    <br>

    Dayoff Arrangement 假期安排:
    <input type="checkbox" checked>
    Sunday Holiday(星期日放假),

    <input type="checkbox" checked>
    Weekday Holiday (平日放假),

    <input type="checkbox" checked>
    Arrangement by Employer (由僱主安排), .

    <br>

    Do you mind provide your accommodation picture for helpers 僱主是否願意提供傭工住宿處相片:
    <input type="checkbox"> YES 願意 /
    <input type="checkbox" checked> NO 不願意
</div>
