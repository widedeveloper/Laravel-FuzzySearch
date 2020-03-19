<script>
    $(function(){
        $('#resulttable').DataTable( {
            "bPaginate": true,
            "searching": false,
            "bFilter": false, 
            "bInfo": false,
            "scrollX": true,
            "bSortable": false,
            "ordering": false
        } );
    })
</script>
<span class="desc">Search Result</span>
<table id="resulttable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
 <thead>
  <tr>
  @foreach ($conditionHeaders as $key=>$item)
    @if (in_array($key, $search_row))
      <th>{{ $item }}</th>
    @endif
  @endforeach
      <th></th>
  @foreach ($fieldLists as $item)
      <th>{{ $item }}</th>
  @endforeach
   </tr>
 </thead>
 <tbody>
   @php
    $i = 0;   
   @endphp
 @foreach($search_result as $row)
  <tr>
    @foreach ($conditionContents[$i] as $key=>$value)
      @if (in_array($key, $search_row))
        <td>{{ $value }}</td>
      @endif
    
    @endforeach
    <td></td>
    @if ( empty($row) )
      <td colspan="{{count($fieldLists)}}">****0 Record Found****</td>
    @else
      @foreach ($fieldLists as $item)
      <td>{{ $row->$item }}</td>
      @endforeach
    @endif
  </tr>
  @php
    $i++;
  @endphp
 @endforeach
 </tbody>
</table>


