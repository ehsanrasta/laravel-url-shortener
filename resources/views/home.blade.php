@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <link-chart-component></link-chart-component>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-sm-12 col-md-4">
            <all-links-component></all-links-component>
        </div>

        <div class="col-sm-12 col-md-7">
            <selected-link-information-component></selected-link-information-component>
        </div>
    </div>
@endsection
