<table class="myTable" width="100%">
    @foreach ($list as $key=>$value)
    <tr @if ($value['isUser'] == true){!! 'class="first"'!!}@endif>
      <td>{{$key+1}}<img src="images/@if ($value['scale'] > 0 ){{ 'up.png' }}@elseif ($value['scale'] < 0 ){{ 'down.png' }}@else{{'equal.png'}}@endif" /></td>
      <td>{{$value['name']}}</td>
      <td>{{$value['wealth']}}</td>
      <td>@if ($value['scale'] > 0 ){{ '+%' }}@elseif ($value['scale'] < 0 ){{ '-%' }}@endif{{abs($value['scale'])}}</td>
      <td>{{$value['from']}}</td>
      <td>{{$value['location']}}</td>
    </tr>
    @endforeach
</table>
