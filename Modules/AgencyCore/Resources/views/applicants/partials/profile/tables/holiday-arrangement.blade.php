<table class="table table-sm m-0">
    <tbody>
    <tr>
        <td colspan="5">
            Holiday Arrangement 假期安排
        </td>

    </tr>
    <tr>
        <td>
            Sunday 星期日 @if($applicant->holiday_arrangement->sunday) <span><i class="fa-solid fa-check"></i></span> @endif
        </td>
        <td>
            Weekday 平日 @if($applicant->holiday_arrangement->weekday) <span><i class="fa-solid fa-check"></i></span> @endif
        </td>
        <td>
            Alternative 輪班 @if($applicant->holiday_arrangement->alternative) <span><i class="fa-solid fa-check"></i></span> @endif
        </td>
        <td>
            No holidays 沒有假期 @if($applicant->holiday_arrangement->no_holidays) <span><i class="fa-solid fa-check"></i></span> @endif
        </td>
        <td>
            Once a month 每月一次 @if($applicant->holiday_arrangement->once_a_month) <span><i class="fa-solid fa-check"></i></span> @endif
        </td>
    </tr>

    </tbody>
</table>
