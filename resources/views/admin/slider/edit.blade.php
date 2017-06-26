@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Slider
        <small class="text-danger">Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.slider.getEdit', $slider->id) }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="form-group">
                <label>Phim đã chọn: </label>
                <strong>{!! $slider->filmList->film_name_en.'-'.$slider->filmList->film_name_en.' ['.$slider->filmList->film_years !!}]</strong>
            </div>
            <div class="form-group">
                <label>Chọn phim khác:</label>
                <select name="film_id" class="form-control">
                @foreach($film_list as $data)
                    <option value="{!! $data->id !!}">{!! $data->film_name_vn.' - '.$data->film_name_en.' ['.$data->film_years !!}]</option>
                @endforeach
                </select>
                {!! $film_list->render() !!}
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Update Slider">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
