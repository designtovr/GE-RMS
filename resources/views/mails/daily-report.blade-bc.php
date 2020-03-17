<!DOCTYPE html>
<html>
<head>
    <title>Daily Report</title>
    <style type="text/css">

      table {
  border-collapse: collapse;
  font-family: 'Poppins', sans-serif !important;
  font-weight: 600;
}

table,  td {
  border: 1px solid black;
  color: black;
  font-family: 'Poppins', sans-serif !important;
  font-weight: 600;
}
.main-content
{

}
h2
{
  font-size: 1em;
color:black;
font-family: 'Poppins', sans-serif !important;
font-weight: 600;
}

thead
{color: white;
background: black;
  border: 1px solid black;
font-family: 'Poppins', sans-serif !important;
font-weight: 600;}

th
{
    border: 1px solid white;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 600;
}

ul li
{
  list-style: none;
}

/*        table, th, tr {
          border: 1px solid black;
      }
      ul#tablerowlist li {
          display:inline;
          width: 33%;
      }*/
  </style>
</head>
<body style ="font-family: 'Poppins', sans-serif !important;">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
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
            </ul>
            <ul class="tablerowlist" id="tablerowlist"style ="width : 40%;float:left">
                <li>
                    <h2>Total Relays Completed</h2>

                    <table>
                        <thead>
                            <th>Family</th>
                            <th>Repair</th>
                            <th>Test</th>
                            <th>Dispatch</th>
                            <th>Total</th>
                        </thead>
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
                </ul>
            <ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
            

                    <li>
                        <h2>Total Relays Overdue</h2>
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
            <ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
                <li>
                    <h2>Total Chargeable</h2>

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
                     </ul>
     <ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
                <li>
                    <h2>Total Completed</h2>

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
                         <tr>
                             <td >{{$total_completed['CONVENTIONAL']}}</td>
                             <td >{{$total_completed['NUMERICAL']}}</td>
                             <td >{{$total_completed['MULTILIN']}}</td>
                             <td >{{$total_completed['REASON']}}</td>
                             <td >{{$total_completed['BOJ']}}</td>
                             <td >{{$total_completed['total']}}</td>
                         </tr>
                     </tbody>
                 </table>
             </li>
                  </ul>
                  <br>
     <ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:right">
             <li>
                <h2>Warranty Overdue</h2>

                <table>
                    <thead>
                        <th>Family</th>
                        <th>Overdues</th>
                    </thead>
                    <tbody>
                      @foreach ($warranty_overdue as $relays)
                      <tr>
                         <td >{{$relays->type_name}}</td>
                         <td >{{$relays->total}}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </li>
     </ul>
     <ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
        <li>
            <h2>Repair Lead Time</h2>

            <table>
                <thead>
                    <th>Type / Category</th>
                    <th>Days</th>
                </thead>
                <tbody>
                 @foreach ($repair_lead_time as $relays)
                 <tr>
                     <td >{{strtoupper($relays->type_name)}}</td>
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
