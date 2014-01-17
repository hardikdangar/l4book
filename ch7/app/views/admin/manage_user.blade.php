@extends('layouts.admin')
@section('content')
 <table class="table table-striped table-bordered table-condensed  sr-table">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Credit</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($users))
            @foreach($users as $value)
                <tr>
                    <td>{{ $value->first_name }}</td>
                    <td>{{ $value->last_name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->credit }}</td>
                    <td>
                    @if($value->activated=="1")
                            <span class="label label-success">Active</span>
                    @endif
                    @if($value->activated=="0")
                            <span class="label label-important">Block</span>
                    @endif
                    &nbsp;
                    </td>
                    <td><a href="{{ URL::to('users/edituser/' . $value->id) }}" class="btn"><i class="icon-pencil"></i> Edit</a>
                        <a href="{{ URL::to('users/delete/' . $value->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> Delete</a>
                        @if($value->activated=="1")
                            <a href="{{ URL::to('users/block/' . $value->id) }}" class="btn btn-danger"><i class="icon-ban-circle"></i> Block</a>
                        @endif
                        @if($value->activated=="0")
                            <a href="{{ URL::to('users/active/' . $value->id) }}" class="btn btn-success"><i class="icon-ok-circle"></i> Active</a>
                        @endif
                        <a href="{{ URL::to('users/creditorder/' . $value->id) }}" class="btn btn-info"><i class="icon-list"></i> Purchase Credit Order</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="sr-align-center">No Users Found</td>
            </tr>
        @endif
    </tbody>
</table>
@stop