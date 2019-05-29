@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <link-chart-component></link-chart-component>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="d-flex justify-content-between">
                <small class="form-text text-muted">4 links</small>
                <small class="form-text text-muted">Clicks all time</small>
            </div>
            <b-list-group class="overflow-auto" style="max-height: 300px">
                <b-list-group-item href="#some-link" active class="d-flex align-items-start flex-column">
                    <small class="d-flex w-100 text-uppercase">May 29</small>
                    <div class="d-flex w-100 justify-content-between">
                        <h5>twitter.com</h5>
                        <span>5 <i class="far fa-chart-bar"></i></span>
                    </div>
                    <small>short.test/<b>jW8Kl2</b></small>
                </b-list-group-item>
                <b-list-group-item href="#some-link" class="d-flex align-items-start flex-column">
                    <small class="d-flex w-100 text-uppercase">May 29</small>
                    <div class="d-flex w-100 justify-content-between">
                        <h5>twitter.com</h5>
                        <span>5 <i class="far fa-chart-bar"></i></span>
                    </div>
                    <small>short.test/<b>jW8Kl2</b></small>
                </b-list-group-item>
            </b-list-group>
        </div>

        <div class="col-sm-12 col-md-8 bg-white">
            <small class="text-muted text-uppercase">
                Created May 29th 2018 |
            </small>

            <small>
                <a href="">etienneac</a>
            </small>

            <h4 class="mt-3 mb-3">twitter.com</h4>

            <small><a href="">short.test/<b>jW8Kl2</b></a></small>
            <b-button variant="outline-primary btn-sm">Copy</b-button>
            <b-button variant="outline-primary btn-sm">Edit</b-button>

            <hr>

            <div class="d-flex-flex-column align-items-start">
                <span class="">5 </span><i class="far fa-chart-bar"></i>
                <small class="d-flex text-muted text-uppercase mb-1">Total clicks</small>
            </div>
        </div>
    </div>
@endsection
