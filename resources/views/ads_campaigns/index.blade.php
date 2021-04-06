<div>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Start</th>
        <th>End</th>
        <th>Daily Cap</th>
        <th>PTR</th>
        <th>Priority</th>
        <th>More Details</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($adsCampaigns as $adsCampaign)
      <tr>
        <td>{{$adsCampaign->id}}</td>
        <td>{{$adsCampaign->start_at}}</td>
        <td>{{$adsCampaign->end_at}}</td>
        <td>{{$adsCampaign->daily_cap}}</td>
        <td>{{$adsCampaign->ptr}}</td>
        <td>{{$adsCampaign->priority}}</td>
        <td>
          <a href="{{route('ads_campaigns.show', $adsCampaign)}}">More Details</a>

        </td>
      </tr>
      @endforeach

    </tbody>
  </table>


</div>