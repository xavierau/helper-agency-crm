<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Applicant Profile</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <meta name="theme-color" content="#fafafa">

    <style>
        th {
            background-color: pink
        }

        span.underline {
            text-decoration: underline;
        }

        span.underline:before,
        span.underline:after {
            content: '0';
            text-decoration: underline;
            color: transparent;
        }
    </style>
</head>

<body>
<!-- Add your site or application content here -->

<div class="container mb-3">
    @include('agencycore::applicants.partials.profile.header')

    <div class="row border">
        <div class="col-8 border">
            <div class="row">
                @include('agencycore::applicants.partials.profile.tables.name')
                @include('agencycore::applicants.partials.profile.tables.nationality')
                @include('agencycore::applicants.partials.profile.tables.marital')
                @include('agencycore::applicants.partials.profile.tables.education')
                @include('agencycore::applicants.partials.profile.tables.others')
            </div>
        </div>
        <div class="col-4 border" style="overflow: hidden">
            @include('agencycore::applicants.partials.profile.thumbnail')
        </div>

        @include('agencycore::applicants.partials.profile.tables.family')
        @include('agencycore::applicants.partials.profile.tables.experience')
        @include('agencycore::applicants.partials.profile.tables.preference')

        <div class="m-0 p-0 d-inline-block" style="width:50%">
            @include('agencycore::applicants.partials.profile.tables.language')
        </div>

        <div class="m-0 p-0 d-inline-block" style="width:50%">
            @include('agencycore::applicants.partials.profile.tables.overseas')
        </div>

        @include('agencycore::applicants.partials.profile.tables.holiday-arrangement')
        @include('agencycore::applicants.partials.profile.tables.habits')

        <hr/>

        <div class="p-1 border-top">
            <section>
                <strong>Declaration:</strong>
                <p>
                    This is the default profile declaration. You can change this.
                </p>
            </section>
        </div>
    </div>
</div>

</body>

</html>
