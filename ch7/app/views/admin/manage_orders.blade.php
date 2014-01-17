@extends('layouts.admin')

@section('content')
{{ Form::open( array( 'url' => 'admin/orders/search')) }}

 <label style="display: inline-block">Order Status :</label>&nbsp;
 {{ Form::select('status', array('0'=>'-- Select Status --')+Config::get('app.status'),Input::get('status'), array('class'=>'input-medium')) }}

 <input type="submit" name="submit" value="Search" class="btn btn-info " style="display: inline-block">
{{ Form::close() }}
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Order No.</th>
            <th>Email</th>
            <th>Message</th>
            <th>Picture</th>
            <th>Status</th>
            <th>Export Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
		@foreach($orders as $value)
                <tr>
                     <th>{{ $value->id }}</th>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->message }}</td>
                    <td>@if($value->image!="")

                             @if(File::exists(public_path().'/img/thumbnails/'.$value->image))
                              {{ HTML::image('img/thumbnails/'.$value->image, "Foldagram Image", array('width'=>'100px')) }}
                            @else
                              {{ HTML::image ('img/thumbnails/100x100.png') }}
                            @endif
                        @endif

                         </td>
                     <td> <?php $status = Config::get('app.status'); ?>

                        <span class="label label-important"><?php echo  $status[$value->status==0?1:$value->status]; ?></span>

                        </td>
                        <td>
                            @if($value->exported=="1")
                                <span class="label label-success">Success</span>
                            @else
                                <span class="label">Not Exported</span>
                            @endif
                        </td>
                    <td>
                        <a href="{{ URL::to('admin/recipient/' . $value->id) }}" class="btn"><i class="icon-pencil"></i> View Recipient's</a>&nbsp;
                        <a href="{{ URL::to('admin/orderdetail/' . $value->id) }}" class="btn btn-info"><i class="icon-pencil"></i> Order Details</a>&nbsp;
                        <a href="{{ URL::to('admin/update/' . $value->id) }}" class="btn btn-success"><i class="icon-pencil"></i> Update Status</a>&nbsp;
                        <a href="{{ URL::to('admin/delete/' . $value->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
	</tbody>
</table>
@stop