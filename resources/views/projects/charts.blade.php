@extends('projects.show')

@section('charts')
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['gantt']
        });
        google.charts.setOnLoadCallback(drawChart);

        function daysToMilliseconds(days) {
            return days * 24 * 60 * 60 * 1000;
        }

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            data.addRows([
                <?php
                foreach($data['tasks'] as $task) {
                    $dstring = "";
                    $fstring = "";

                    foreach($task->todofirst($task->id) as $idtp) {
                        $dstring .= (string)$idtp->id_priority.", ";
                    }

                    if ($task->fdate <> null) {
                        $fstring = "100";
                    }
                    echo "['".$task-> id.
                    "', '".$task-> name.
                    "', new Date('".$task-> bdate.
                    "'), new Date('".$task-> edate.
                    "'), , ".$fstring.
                    ", '".$dstring.
                    "'],";
                }?>
            ]);

            var options = {
                height: 500
            };

            var chart = new google.visualization.Gantt(document.getElementById('ganttchart'));
            chart.draw(data, options);
        }

    </script>

    <br>
    <div id="ganttchart" style="overflow: scroll;"></div>

@endsection
