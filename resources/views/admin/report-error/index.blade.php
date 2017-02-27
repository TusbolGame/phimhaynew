@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Report Error - Báo cáo Lỗi  của User
        <small class="text-danger">List</small>
    </h1>
</div>
@endsection
@section('content')
    <input type="hidden" class="token-data" name="_token" value="{!! csrf_token() !!}">
    <table class="admin-table table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th><label>All
                    <input type="checkbox" class="select_report_error_all" value="all"></label>
                </th>
                <th>ID</th>
                <th>Report Error Name</th>
                <th>Report Status</th>
                <th>Film Id</th>
                <th>User Id</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Chi Tiết</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($film_report_error as $data)
                <tr>
                    <td class="text-center"><input type="checkbox" class="report_error_id" value="{{ $data->id }}"></td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->report_error_name }}</td>
                    @if($data->report_error_status == 0)
                        <td class="bg-danger">Chưa xem</td>
                    @else
                        <td class="bg-success">Đã xem</td>
                    @endif
                    <td>{{ $data->id  }}</td>
                    <td>{{ $data->user_id  }}</td>
                    <td>{{ $data->created_at  }}</td>
                    <td>{{ $data->updated_at  }}</td>
                    <td>
                        <a href="{!! route('admin.report-error.show', $data->id) !!}">Xem</a>
                    </td>
                    <td>
                        <form action="{!! route('admin.report-error.destroy', $data->id) !!}" method="POST" accept-charset="utf-8">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{!! $data->id !!}">
                            <button type="submit" onclick="return checkDelete('Bạn có muốn xóa Report Id: {!! $data->id !!} ?');">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        
        <form action="{!! route('admin.report-error.postReadArray') !!}" method="POST" accept-charset="utf-8" class="form-inline form-report-error-read">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" class="report-error-read-id" name="report_error_id" value="">
            <button type="submit" onclick="return getReportErrorIdRead();" class="btn btn-success">Đánh dấu đã đọc</button>
        </form>
        <br>
        <form action="{!! route('admin.report-error.postDeleteArray') !!}" method="POST" accept-charset="utf-8" class="form-inline form-report-error-delete">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" class="report-error-delete-id" name="report_error_id" value="">
            <button type="submit" onclick="return getReportErrorIdDelete();" class="btn btn-danger">Xóa đã chọn</button>
        </form>
    </div>
    <script>
        $('.select_report_error_all').click(function() {
            
            if($(this).prop('checked') == true){
                //check all
                $('.report_error_id').each(function(){
                    $(this).attr('checked', true);
                });
            }else{
                //not check all
                $('.report_error_id').each(function(){
                    $(this).attr('checked', false);
                });
            }
        });
        function getReportErrorIdRead(){
             $data_id = new Array();
            $('.report_error_id:checked').each(function(){
                $data_id.push($(this).val());
            });
            //update read_id
            $('.form-report-error-read input.report-error-read-id').val($data_id);
            return true;
        }
        function getReportErrorIdDelete(){
             $data_id = new Array();
            $('.report_error_id:checked').each(function(){
                $data_id.push($(this).val());
            });
            //update read_id
            $('.form-report-error-delete input.report-error-delete-id').val($data_id);
            return true;
        }
    </script>
@endsection
