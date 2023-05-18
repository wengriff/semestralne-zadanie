<!-- Shows detailed information about student's equations-->
<head>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/studentDetailsTable.js') }}"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    </head>
    
<x-app> 
<x-card class="p-10 w-75 mx-auto mt-24">
    <h2>{{ $student->name }} {{ $student->surname }}</h2>
    <table class="table table-striped table-bordered table-hover" id="studentDetailsTable">
        <thead>
            <tr>
                <th>{{__('studentDetail.points')}}</th>
                <th>{{__('studentDetail.isSub')}}</th>
                <th>{{__('studentDetail.answer')}}</th>
                <th>{{__('studentDetail.isCorrect')}}</th>
                <th>{{__('studentDetail.points')}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($student->assignments as $assignment)

        @if($assignment->status != 'not_generated')
    <tr>
    <td>
    @if($assignment->status != 'not_generated')
    @if($assignment->mathProblem->image_path != '')
        @php
            $imagePathParts = explode("/", $assignment->mathProblem->image_path);
            $imageFileName = end($imagePathParts);
        @endphp

        <img src="{{ asset('storage/images/' . $imageFileName) }}" alt="Problem Image">
    @elseif($assignment->mathProblem->equation!= '')
            <p>\({{$assignment->mathProblem->equation}}\)</p>
    @endif
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

    \({{$assignment->student_solution}}\)
        @endif</td>

    <td>
        @if($assignment->status == 'submitted_100')
        <i class="fa fa-check"></i>
    @elseif($assignment->status == 'submitted_0')
        <i class="fa fa-times"></i>
    @endif
    </td>
    <td>@if($assignment->status != 'not_generated' && $assignment->status != 'generated')
        @if($assignment->status == 'submitted_0')
            0
        @elseif($assignment->status == 'submitted_100')
            {{$assignment->mathProblem->assignmentSet->points}}


        @endif
        @endif
    </td>
</tr>
@endif
@endforeach
        </tbody>
    </table>

</x-card>
</x-app>
