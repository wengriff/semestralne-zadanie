<!-- Shows detailed information about the student-->
<head>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/studentTable.js') }}"></script> 
    </head>
<x-app>
<x-card class="p-5  w-50 mx-auto mt-24">
<table class="table table-striped table-bordered table-hover" id="studentTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Generated Equations</th>
                <th>Submitted Equations</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>
                        <a href="{{ route('student_details', ['id' => $student->id]) }}">
                            {{ $student->name }}
                        </a>
                    </td>
                    <td>{{ $student->surname }}</td>
                    <td>{{ $student->generated_equations_count }}</td>
                    <td>{{ $student->submitted_equations_count }}</td>
                    <td>{{ $student->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</x-card>
</x-app>