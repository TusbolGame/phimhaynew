@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Online
        <small>Views</small>
    </h1>
</div>
@endsection
@section('content')
{{-- online --}}
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-hand-right"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $user_access+$guest_accesss !!}</div>
                        <div>Total Online</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $user_access !!}</div>
                        <div>User Online</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-tree-deciduous"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $guest_accesss !!}</div>
                        <div>Guest Online</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
