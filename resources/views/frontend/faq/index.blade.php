@extends('_frontend_layout')

@section('content')

    <!-- Contact-->
    <section class="page-section">
        <div class="container">
            <div class="row row-grid">
                <div class="col-lg-10 offset-md-1">
                    <!-- Theme integration -->
                    <div class="mb-5">
                        <h4 class="mb-4 text-center">{{ __('How can we help you?') }}</h4>

                        <form action="{{ route('frontend.faq') }}" method="get">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Search">
                            </div>
                        </form>

                        <p class="mb-5 text-center">{{ __('You can also browse the topics below to find what you are looking for.') }}</p>

                        <!-- Accordion -->
                        <h4 class="mb-4 text-center">{{ __('Frequently Asked Question?') }}</h4>

                        <div id="accordion-1" class="accordion accordion-spaced">
                            @if(!blank($faqs))
                                @foreach($faqs as $faq)
                                    <div class="card">
                                        <div class="card-header py-4" id="heading-{{ $faq->id }}" data-toggle="collapse" role="button" data-target="#collapse-{{ $faq->id }}" aria-expanded="false" aria-controls="collapse-{{ $faq->id }}">
                                            <h6 class="mb-0"><i class="fas fa-question-circle mr-3"></i>{{ $faq->title }}</h6>
                                        </div>
                                        <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading-{{ $faq->id }}" data-parent="#accordion-1">
                                            <div class="card-body">
                                                {{ strip_tags($faq->description) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="font-weight-bold text-center text-danger">{{ __('The searching data not found. Please contact with help desk via contact page.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section

@endsection

