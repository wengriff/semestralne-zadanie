<!-- Shows detailed information about student's equations-->
<head>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/studentDetailsTable.js') }}"></script> 
    </head>
<x-app>
<x-card class="p-10 w-50 mx-auto mt-24">
    <h2>{{ $student->name }} {{ $student->surname }}</h2>
    <table class="table table-striped table-bordered table-hover" id="studentDetailsTable">
        <thead>
            <tr>
                <th>Problem</th>
                <th>Is Submitted</th>
                <th>Student's Answer</th>
                <th>Is Correct</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
        @foreach($student->assignments as $assignment)
        @php
            $imagePathParts = explode("/", $assignment->mathProblem->image_path);
            $imageFileName = end($imagePathParts);
        @endphp
        @if($assignment->status != 'not_generated')
    <tr>
    <td>
    @if($assignment->status != 'not_generated')
    <img src="{{ asset('storage/images/' . $imageFileName) }}" alt="Problem Image">
    @endif
    </td>
    <td>
    @if($assignment->status == 'submitted_100' || $assignment->status == 'submitted_0')
        <i class="fa fa-check"></i> 
    @elseif($assignment->status == 'generated')
        <i class="fa fa-times"></i> 
    @endif
    </td>
    <td>@if($assignment->status != 'not_generated' && $assignment->status != 'generated')
        TODO
        @endif</td>
    
    <td>
        @if($assignment->status == 'submitted_100')
        <i class="fa fa-check"></i> 
    @elseif($assignment->status == 'submitted_0')
        <i class="fa fa-times"></i> 
    @endif
    </td>
    <td>@if($assignment->status != 'not_generated' && $assignment->status != 'generated')
        {{$assignment->mathProblem->assignmentSet->points}}
        @endif
    </td>
</tr>
@endif
@endforeach
        </tbody>
    </table>
</x-card>
</x-app>