<!-- Shows detailed information about student's equations-->
<head>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/studentDetailsTable.js') }}"></script> 
    </head>
<x-app>
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <h2>{{ $student->name }} {{ $student->surname }}</h2>
    <table class="table table-striped table-bordered table-hover" id="studentDetailsTable">
        <thead>
            <tr>
                <th>Equation</th>
                <th>Submitted Answer</th>
                <th>Correct Answer</th>
                <th>Status</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->submissions as $submission)
                <tr>
                    <td>{{ $submission->equation->content }}</td>
                    <td>{{ $submission->submitted_answer }}</td>
                    <td>{{ $submission->equation->correct_answer }}</td>
                    <td>{{ $submission->is_correct ? 'Correct' : 'Incorrect' }}</td>
                    <td>{{ $submission->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-card>
</x-app>