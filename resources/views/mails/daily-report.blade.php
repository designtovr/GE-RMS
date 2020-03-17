<!DOCTYPE html>
<html>
<head>
    <title>Daily Report</title>
    <style type="text/css">
        table, th, tr {
          border: 1px solid black;
      }
      ul#tablerowlist li {
          display:inline;
          width: 33%;
      }
  </style>
</head>
<body>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <ul class="tablerowlist" id="tablerowlist">
                <li>
                    <h2>Received Relays</h2>
                    <table>
                        <thead>
                            <th>Family</th>
                            <th>Number of Relays Received</th>
                            <th>Cumulative Relays</th>
                        </thead>
                        <tbody>
                            @foreach ($received_relays as $relays)
                            <tr>
                                <td >{{$relays->type_name}}</td>
                                <td >{{$relays->total}}</td>
                                <td >{{$relays->cumulative}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </li>
                <li>
                    <h2>Received Relays</h2>

                    <table>
                        <thead>
                            <th>Family</th>
                            <th>Repair</th>
                            <th>Test</th>
                            <th>Dispatch</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            <tbody>
                              <tbody>
                                  @foreach ($total_relays_completed as $relays)
                                  <tr>
                                    <td >{{$relays->type_name}}</td>
                                    <td >{{$relays->repair}}</td>
                                    <td >{{$relays->test}}</td>
                                    <td >{{$relays->dispatch}}</td>
                                    <td >{{$relays->total}}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </li>
                    <li>
                        <h2>Received Relays</h2>
                        <table>
                            <thead>
                                <th>Family</th>
                                <th>Repair</th>
                                <th>Test</th>
                                <th>Dispatch</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                              @foreach ($total_relays_overdues as $relays)
                              <tr>
                                <td >{{$relays->type_name}}</td>
                                <td >{{$relays->repair}}</td>
                                <td >{{$relays->test}}</td>
                                <td >{{$relays->dispatch}}</td>
                                <td >{{$relays->total}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </li>
            </ul>
            <ul class="tablerowlist" id="tablerowlist">
                <li>
                    <h2>Received Relays</h2>

                    <table>
                        <thead>
                            <th>Family</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @foreach ($total_chargeable as $relays)
                            <tr>
                                <td >{{$relays->type_name}}</td>
                                <td >{{$relays->total}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </li>
                <li>
                    <h2>Received Relays</h2>

                    <table>
                        <thead>
                            <th>Conventional</th>
                            <th>Numerical</th>
                            <th>Multilin</th>
                            <th>Recent</th>
                            <th>BOJ</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                         @foreach ($total_completed as $relays)
                         <tr>
                             <td >{{$relays->CONVENTIONAL}}</td>
                             <td >{{$relays->NUMERICAL}}</td>
                             <td >{{$relays->MULTILIN}}</td>
                             <td >{{$relays->REASON}}</td>
                             <td >{{$relays->BOJ}}</td>
                             <td >{{$relays->total}}</td>
                         </tr>
                         @endforeach

                     </tbody>
                 </table>
             </li>
             <li>
                <h2>Received Relays</h2>

                <table>
                    <thead>
                        <th>Family</th>
                        <th>Overdues</th>
                    </thead>
                    <tbody>
                      @foreach ($total_completed as $relays)
                      <tr>
                         <td >{{$relays->CONVENTIONAL}}</td>
                         <td >{{$relays->NUMERICAL}}</td>
                         <td >{{$relays->MULTILIN}}</td>
                         <td >{{$relays->REASON}}</td>
                         <td >{{$relays->BOJ}}</td>
                         <td >{{$relays->total}}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </li>
     </ul>
     <ul class="tablerowlist" id="tablerowlist">
        <li>
            <h2>Received Relays</h2>

            <table>
                <thead>
                    <th>Type / Category</th>
                    <th>Days</th>
                </thead>
                <tbody>
                 @foreach ($repair_lead_time as $relays)
                 <tr>
                     <td >{{$relays->type_name}}</td>
                     <td >{{$relays->average}}</td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </li>
 </ul>
</div>
</div>
</body>
</html>
