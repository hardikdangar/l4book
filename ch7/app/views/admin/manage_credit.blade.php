@extends('layouts.admin')

@section('content')
 <table class="table table-striped table-bordered table-condensed  sr-table">
    <thead>
        <tr>
            <th>Range</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($credit)
            @foreach($credit as $value)
                <tr>
                    <td>{{ $value->rfrom . " - ". $value->rto }}</td>
                    <td>{{ $value->price }}</td>
                    <td><a href="{{ URL::to('admin/editcredit/' . $value->id) }}" class="btn"><i class="icon-pencil"></i> Edit</a>
                        <a href="{{ URL::to('admin/deletecredit/' . $value->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" class="sr-align-center">Record Not Found</td>
            </tr>
        @endif
    </tbody>
</table>
@stop