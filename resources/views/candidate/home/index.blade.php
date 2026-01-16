@extends('candidate.layouts.main')

@section('content')
@php
    use App\Models\Location;
    use App\Models\Language;
    use App\Models\Occupation;
@endphp
<div class="content-full">
    <div class="avatar">
        <img width="1102" height="364" src="{{ asset('images/my-home.png') }}" alt="my home avatar">
    </div>
    @if (auth('web')->check())
    <div class="main-content" style="position: relative;">
        <div class="main-preview">
            <div class="d-flex flex-column" style="width: 400px">
                <a href="{{ route('candidate.job.index', [
                    'industry' => $data['resultIndustry'],
                    'occupation' => $data['resultOccupation'],
                ]) }}" class="note"><img src="{{ asset('images/icon-heart-black.svg') }}" alt="">Job listings that match your qualifications<span>「 {{ $data['jobByExpeeienceCount'] }} 」</span></a>
                <a href="{{ route('candidate.job.index', ['salary_requirement' => optional($data['candidate']->resume->resumeRequirementBasic)->requirement_salary ?? 0]) }}" class="note"><img src="{{ asset('images/icon-heart-black.svg') }}" alt="">List of jobs that match the desired salary<span>「 {{ $data['jobBySalaryCount'] }} 」</span></a>
                <a href="{{route('candidate.favorite.index') }}" class="note"><img src="{{ asset('images/icon-interest-black.svg') }}" alt="">Favorite to-do list<span>「 {{ $data['favoriteCount'] }} 」</span></a>
            </div>
        </div>
    </div>
    @else
        <div class="main-content" style="position: relative;">
            <div class="main-preview">
                <div class="" style="width: 400px; color: white; font-size: 21px;">
                    <div>Connecting employers and candidates - Nika: Job search website in Vietnam!</div>
                    <div class="pl-3">- Here, we can help you find a job that suits your true self.</div>
                </div>
            </div>
        </div>
    @endif
    <form action="{{ route('candidate.job.index') }}" method="GET">
        <div class="quick-search">
            <div class="search-title">Quick search</div>
            <p class="counter">Jobs that match your search criteria
                <span class="roboto">{{ $job_counts }}</span>Jobs
            </p>
            <div class="search-condition">
                <div class="s-c-select">
                    <select class="search-select" name="location" id="selectbox1" data-url="{{ route('candidate.job.count-job') }}">
                        <option value="">Choose Country</option>
                        @foreach ($locationColection as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="s-c-select">
                    <select class="search-select" name="language" id="selectbox2">
                        <option value="">Choose Language</option>
                        @foreach ($languageColection as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="s-c-select">
                    <select class="search-select" name="occupation_id" id="selectbox3">
                        <option value="">Choose Occupation</option>
                        @foreach ($occupationColection as $occupation)
                            <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="s-c-keyword">
                    <input class="s-c-input" id="key" name="key" type="text" placeholder="Search by Keyword">
                </div>
            </div>
            <div class="d-flex flex-row-reverse quick-search-submit">
                <button type="submit" class="btn btn-primary d-flex align-items-end">Search</button>
                <a href="{{ route('candidate.job.index') }}" class="d-flex align-items-center">Advanced Search</a>
            </div>
        </div>
    </form>
    <div class="mt-4">
        <div class="card-jobs">
            <div class="card card-location" style="width: 72%;">
                <div class="card-header">
                    <div>
                        <img width="24" height="24" src="{{ asset('images/icon-spot.svg') }}"  alt="">
                        <span class="small-sub-title mb-sub-title">Jobs By Location</span>
                        <div class="card-border"></div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="location content-location">
                        @foreach ($data['locations'] as $location)
                            <a href="{{route('candidate.job.index', ['location' => $location->id])}}">- {{ $location->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-location" style="width: 25%;">
                <div class="card-header">
                    <img width="24" height="24" src="{{ asset('images/icon-book.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Language</span>
                    <div class="card-border"></div>
                </div>
                <div class="card-content">
                    <div class="location d-flex flex-column">
                        @foreach ($data['languages'] as $language)
                            <a href="{{ route('candidate.job.index', ['language' => $language->id]) }}">- {{ $language->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 feature">
        <div class="feature-jobs">
            <div class="card">
                <div class="card-header">
                    <img width="24" height="24" src="{{ asset('images/icon-job-black.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Jobs By Feature</span>
                    <div class="card-border"></div>
                </div>
                <div class="card-content">
                    <div class="feature-flex d-flex justify-content-between">
                        @foreach ($data['features'] as $index => $feature)
                            <a href="{{ route('candidate.job.index' , ['feature_id' => [$feature->id]]) }}">
                                <div class="feature-item">
                                    <img src="{{ asset("images/feature/feature_{$index}.png") }}" alt="" class="img-content">
                                    <div class="l-content" style="">
                                        <div class="location-title">{{ $feature->name }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 company">
        <div class="r-company d-flex justify-content-between">
            <div class="c-j-name" style="width: 66%;">
                <div class="c-header">
                    <img width="24" height="24" src="{{ asset('images/icon-building-white.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Recommended Company</span>
                    <div class="c-border" style="width: 235px;"></div>
                </div>
                <div class="c-content mt-3">
                    <div class="d-flex justify-content-between company-flex">
                        @foreach ($data['companies'] as $company)
                            <a href="{{ route('candidate.companies', ['id' => $company->id]) }}" class="c-detail">
                                <div class="c-d-content d-flex">
                                    <div class="c-d-content-left">
                                        <img src="{{ asset('storage/' . $company->upload_file_path) }}" alt="">
                                    </div>
                                    <div class="c-d-content-right">
                                        <div class="c-des">{{ $company->name }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="c-j-name" style="width: 31%;">
                <div class="c-header">
                    <span class="small-sub-title mb-sub-title">Recommended Jobs</span>
                    <div class="c-border" style="width: 175px;"></div>
                </div>
                <div class="j-content" style="padding: 20px 0;">
                    <div class="job-flex d-flex justify-content-between">
                        @foreach ($data['jobs'] as $job)
                            <a href="{{ route('candidate.job.show', ['id' => $job->id]) }}" class="j-detail">
                                <div class="j-d-content d-flex">
                                    <div class="j-d-content-left">
                                        <img src="{{ asset('storage/' . $job->company->upload_file_path) }}" alt="">
                                    </div>
                                    <div class="j-d-content-right">
                                        <div class="j-des">{{ $job->job_title }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a href="{{ route('candidate.job.index') }}" class="mt-2 d-block all-job">All jobs
                        <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 job-favorites">
        <div style="font-size: 20px;
        line-height: 28px;
        border-bottom: 4px solid black; color: blue;" class="py-2">New Jobs</div>
        @foreach ($data['jobNews'] as $jobNew)
            <div class="mt-2 py-2 d-flex" style="color:green ;border-bottom: 1px solid #eee">
                <div class="w-25">{{ formatDate($jobNew->updated_at) }}</div>
                <a href="{{ route('candidate.job.show', ['id' => $jobNew->id]) }}" class="new-job" class="w-75">{{ $jobNew->job_title }}</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $( function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#selectbox1, #selectbox2, #selectbox3').change(function() {
                let location = $('#selectbox1').find(":selected").val();
                let language = $('#selectbox2').find(":selected").val();
                let occupation_id = $('#selectbox3').find(":selected").val();
                let key = $('#key').val();

                let url = $('#selectbox1').data('url');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { location: location, language: language, occupation_id: occupation_id, key: key},
                    success: function(res) {
                        $('.roboto').text(res.result);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#key').keyup(function() {
                let location = $('#selectbox1').find(":selected").val();
                let language = $('#selectbox2').find(":selected").val();
                let occupation_id = $('#selectbox3').find(":selected").val();
                let key = $('#key').val();
                let url = $('#selectbox1').data('url');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { location: location, language: language, occupation_id: occupation_id, key: key},
                    success: function(res) {
                        $('.roboto').text(res.result);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
