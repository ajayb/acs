<br/>
<div id="no-more-tables">
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
            <tr>                
                <th>Number</th>                
                <th>Program</th>
                <th>Project</th>
                <th>Serial Number</th>
                <th>KW Reading</th>
                <th>Carbon in Pounds</th>
                <th>Cost</th>
                <th>Reading Date/Time</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $i=1; 
            $totalCarbon = 0;
        ?>                         
        @foreach($pvRecords as $record)               
        <tr>
            <td data-title="Number">{{$i}}</td>            
            <td data-title="Program">{{$record['progname']}}</td>
            <td data-title="Project">{{$record['prjname']}}</td>
            <td data-title="Serial Number">{{$record['serial_number']}}</td>
            <td data-title="KW Reading">{{$record['kw_reading']}}</td>
            <td data-title="Carbon in Pounds">{{$record['carbon']}}</td>
            <td data-title="Cost">{{$record['cost']}}</td>
            <td data-title="Reading Date/Time">{{ date('d M Y H:i a', $record['reading_time']) }}</td>
        </tr>       
        <?php 
            $i++; 
            $totalCarbon +=$record['carbon']; 
        ?>
        @endforeach
        <?php 
            $totalCarbon =  ($totalCarbon * $metricValue); 
            $totalCarbon = number_format($totalCarbon, 2, '.', ',');
        ?>
        <tr>
            <td colspan="5" align="right"><strong>Total Carbon in Metric Tonnes</strong></td>            
            <td colspan="3" class="numeric"><strong>{{$totalCarbon}}</strong></td>
        </tr>
        </tbody>
    </table>
</div>
