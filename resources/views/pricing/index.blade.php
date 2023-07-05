@extends('layout.app')

@push('title-page')
    Pricing
@endpush

@push('breadcrumb')
    <li><a href="">Dashboard</a></li>
    <li><span>Pricing</span></li>
@endpush

@section('content')
    <x-admin.box-component>
        @slot('title')
            Pricing
        @endslot
        @slot('boxBody')
            <div class="row">
                <div class="col-xl-3 col-ml-6 col-mdl-4 col-sm-6 mt-5">
                    <div class="card">
                        <div class="pricing-list">
                            <div class="prc-head">
                                <h4>Membership</h4>
                            </div>
                            <div class="prc-list">
                                <ul>
                                    <li><a href="#">Term financing</a></li>
                                    <li><a href="#">Access up to $10,000</a></li>
                                    <li><a href="#">Get: USD</a></li>
                                    <li><a href="#">3-24 Month Terms</a></li>
                                    <li class="bold"><a href="#">1 SALT/year</a></li>
                                </ul>
                                <a href="#">Buy Package</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-ml-6 col-mdl-4 col-sm-6 mt-5">
                    <div class="card">
                        <div class="pricing-list">
                            <div class="prc-head">
                                <h4>Premier</h4>
                            </div>
                            <div class="prc-list">
                                <ul>
                                    <li><a href="#">Term Finnacing & Line of Credit</a></li>
                                    <li><a href="#">Access up to $10,000</a></li>
                                    <li><a href="#">Get: USD, EUR, GBP, JPY, RMB</a></li>
                                    <li><a href="#">1 hour - 36 Month Terms</a></li>
                                    <li class="bold"><a href="#">30 SALT/year</a></li>
                                </ul>
                                <a href="#">Buy Package</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-ml-6 col-mdl-4 col-sm-6 mt-5">
                    <div class="card">
                        <div class="pricing-list">
                            <div class="prc-head">
                                <h4>Enterprise</h4>
                            </div>
                            <div class="prc-list">
                                <ul>
                                    <li><a href="#">Term Finnacing & Line of Credit</a></li>
                                    <li><a href="#">Access up to $10,000</a></li>
                                    <li><a href="#">Get: Ad Hoc Currency Selection</a></li>
                                    <li><a href="#">24 hour - 1 Year Terms</a></li>
                                    <li class="bold"><a href="#">Contact for Pricing</a></li>
                                </ul>
                                <a href="#">Buy Package</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-ml-6 col-mdl-4 col-sm-6 mt-5">
                    <div class="card">
                        <div class="pricing-list">
                            <div class="prc-head">
                                <h4>Platinum</h4>
                            </div>
                            <div class="prc-list">
                                <ul>
                                    <li><a href="#">Term Finnacing & Line of Credit</a></li>
                                    <li><a href="#">Access up to $10,000</a></li>
                                    <li><a href="#">Get: Ad Hoc Currency Selection</a></li>
                                    <li><a href="#">Metered Terms</a></li>
                                    <li class="bold"><a href="#">Contact for Pricing</a></li>
                                </ul>
                                <a href="#">Buy Package</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endslot
    </x-admin.box-component>
@endsection
