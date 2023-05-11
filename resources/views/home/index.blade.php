<head>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/teacherAssignmentsTable.js') }}"></script> 
    </head>

<x-app>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <h1>Dashboard</h1>
        @if($role)
        @if($role=='student')
        <h3>Student Dashboard</h3>
        <p>Student-specific content goes here...</p>
        <!-- https://cortexjs.io/mathlive/guides/interacting/ -->
        <label>Mathfield</label><br>
        <math-field style="
          display: block;
            font-size: 32px;
            margin: 3em;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, .3);
            box-shadow: 0 0 8px rgba(0, 0, 0, .2);
            --caret-color: red;
            --selection-background-color: lightgoldenrodyellow;
            --selection-color: darkblue;
            ">
        </math-field>
        <!-- Student content -->
        @elseif($role == 'teacher')
        <h3>Teacher Dashboard</h3>
        
        <p>Teacher-specific content goes here...</p>
            <table class="table table-striped table-bordered table-hover" id="teacherAssignmentsTable">
            <thead>
                <tr>
                    <th>Assignment set</th>
                    <th>Starting date</th>
                    <th>Deadline</th>
                    <th>Points</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignmentSets as $assignmentSet)
                    <tr>
                        <td>{{ $assignmentSet->id }}</td>
                        <td>{{ $assignmentSet->starting_date }}</td>
                        <td>{{ $assignmentSet->deadline }}</td>
                        <td>{{ $assignmentSet->points }}</td>
                        <td><button hx-get="/contact/1/edit" class="btn btn-primary">
                                Click To Edit
                        </button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Invalid role</p>
        @endif
        @else
        <h3>Welcome to the Homepage</h3>
            <p>Regular homepage content for guests goes here...</p>
            <!-- Guest content -->
        @endif
    </x-card>
</x-app>