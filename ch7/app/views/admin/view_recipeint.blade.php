@extends('layouts.admin')
@section('content')
<h3>Foldagram Recipient's Address</h3>
 <table class="table table-striped table-bordered table-condensed  sr-table">
    <tbody>
        @if(!empty($reff))
            <?php $i = 1; ?>
            @foreach($reff as $value)
                <tr>
                    <th>Recipient's Address {{ $i++ }} </th>
                </tr>
                <tr>
                    <td>
                      <address>
                      <strong>{{ $value->fullname}}</strong><br/>
                      {{  $value->address_one }}
                    </address>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="sr-align-center">Record Not Found</td>
            </tr>
        @endif
    </tbody>
</table>
@stop