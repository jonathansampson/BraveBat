<div>
  <table>
    <tbody>
      <tr>
        <td>{{$adsCampaign->id}}</td>
        <td>{{$adsCampaign->start_at}}</td>
        <td>{{$adsCampaign->end_at}}</td>
        <td>{{$adsCampaign->daily_cap}}</td>
        <td>{{$adsCampaign->ptr}}</td>
        <td>{{$adsCampaign->priority}}</td>
      </tr>

    </tbody>
  </table>

</div>
{{dd(json_decode($adsCampaign->response))}}