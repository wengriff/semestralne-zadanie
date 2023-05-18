<head>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('js/teacherAssignmentsTable.js') }}"></script> 
    <script src="{{asset('js/usersTable.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>


    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
            color: grey;
        }
    </style>
</head>

<x-app>
    <x-card class="p-10 w-50 mx-auto mt-24">

        @if($role)
        @if($role=='student')

        <h2>{{__('index.pickProblems')}}</h2>
        @php
    $disabledStatuses = ['generated', 'submitted_100', 'submitted_0'];
        @endphp

        @php
    $now = \Carbon\Carbon::now();
@endphp

@foreach($assignmentsGroupedBySet as $setID => $assignments)

    @php
        // Assuming the first assignment in each set defines the start and end date for the whole set
        $startDate = \Carbon\Carbon::parse($assignments->first()->assignmentSet->starting_date);
        $endDate = \Carbon\Carbon::parse($assignments->first()->assignmentSet->deadline);

    @endphp

    @if($now->between($startDate, $endDate))
        <div class="card m-1" style="width-50%;">
            <div class="card-body">
                <h3 class="card-title">{{__('index.assignmentS')}}{{ $setID }}</h3>
                <div class="card-text">
                    @foreach($assignments as $assignment)
                    
                        <button id="btn-{{ $assignment->id }}" class="btn btn-primary generate-btn m-1" data-problem-id="{{ $assignment->id }}"{{ in_array($assignment->pivot->status, $disabledStatuses) ? ' disabled' : '' }}>
                            {{__('index.problem')}} {{ $assignment->id }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endforeach

    @foreach($assignmentsGroupedBySet as $setID => $assignments)
    
    @php
        
        $startDate = \Carbon\Carbon::parse($assignments->first()->assignmentSet->starting_date);
        $endDate = \Carbon\Carbon::parse($assignments->first()->assignmentSet->deadline);

    @endphp

    @if($now->between($startDate, $endDate))
<div class="card m-1" style="width-50;">
    <div class="card-body">
        <h3 class="card-title">{{__('index.assignmentS')}}{{ $setID }}</h3>
        <div class="card-text">
            @foreach($assignments as $assignment)
                @if(in_array($assignment->pivot->status, $disabledStatuses))
                <div class="card-body">
                    <div class="row">

                    <div class="col-md-6">
                    @if($assignment->image_path != '')

                        @php
                            $imagePathParts = explode("/", $assignment->image_path);
                            $imageFileName = end($imagePathParts);
                        @endphp

                        <img class="img-fluid" src="{{ asset('storage/images/' . $imageFileName) }}" alt="Problem Image">

                        @elseif($assignment->equation!= '')

                    <p>\({{$assignment->equation}}\)</p>
                    
                    @endif
                    </div>
                        <div class="col-md-6">
                            
                            <a href="{{ route('solve-problem', ['problemId' => $assignment->id]) }}" 
   class="btn btn-primary solve-btn {{ $assignment->pivot->status == 'submitted_100' || $assignment->pivot->status == 'submitted_0' ? 'disabled' : '' }}">
    Solve Problem
</a>                @if($assignment->pivot->status!='not_generated' || $assignment->pivot->status!='generated')
                    @if($assignment->pivot->status == 'submitted_100')
                            <p>{{$assignments->first()->assignmentSet->points}}/{{$assignments->first()->assignmentSet->points}}</p>
                                <i class="fa fa-check"></i> <!-- Check mark icon. Replace with your own icon as needed. -->
                            @elseif($assignment->pivot->status == 'submitted_0')
                            <p>0/{{$assignments->first()->assignmentSet->points}}</p>
                                <i class="fa fa-times"></i> <!-- X icon. Replace with your own icon as needed. -->
                            @endif
                    @endif

             


                        </div>
                    </div>
                     
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endif
@endforeach

        <!-- Student content -->
        @elseif($role == 'teacher')

        <a href="/students"
   class="btn btn-primary">
            {{__('index.students')}}
</a>
<h3>{{__('index.assignments')}}</h3>
            <table class="table table-striped table-bordered table-hover table delete-row-example">
            <thead>
                <tr>
                    <th>{{__('index.assignmentS')}}</th>
                    <th>{{__('index.startDate')}}</th>
                    <th>{{__('index.deadline')}}</th>
                    <th>{{__('index.points')}}</th>
                    <th>{{__('index.submit')}}</th>
                </tr>
            </thead>
            <tbody hx-target="closest tr" hx-swap="outerHTML">
                @foreach($assignmentSets as $assignmentSet)
                    <tr>
                        <td>{{ $assignmentSet->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($assignmentSet->starting_date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($assignmentSet->deadline)->format('d-m-Y') }}</td>
                        <td>{{ $assignmentSet->points }}</td>
                        <td><button class="btn btn-danger" hx-get="{{ route('assignment.edit', $assignmentSet->id) }}"
                        hx-trigger="edit"
                _="on click
                     if .editing is not empty
                       Swal.fire({title: 'Already Editing',
                                  showCancelButton: true,
                                  confirmButtonText: 'Yep, Edit This Row!',
                                  text:'Hey!  You are already editing a row!  Do you want to cancel that edit and continue?'})
                       if the result's isConfirmed is false
                         halt
                       end
                       send cancel to .editing
                     end
                     trigger edit">
                                {{__('index.edit')}}
          </button>
      </td>
      </tr>
                @endforeach
            </tbody>
        </table>

        @elseif($role=='admin')
        <table class="table table-striped table-bordered table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Select new Role</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('user.updateRole', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <select name="role">
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                        </td>
                        <td>
                        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="submit">Change Role</button>
                       </td>
                    </form>
                
            </tr>
        @endforeach
    </tbody>
</table>
        @else
        <p>{{__('index.invalidRole')}}</p>
        @endif
        @else
        <h3>{{__('index.welcomeTHP')}}</h3>
            <p>Regular homepage content for guests goes here...</p>
            <!-- Guest content -->
        @endif
    </x-card>
</x-app>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('.generate-btn').click(function() {
        var problemId = $(this).data('problem-id');

        $.ajax({
            url: '/assignments/update-status',
            type: 'POST',
            data: {
                problem_id: problemId,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success) {
                    // Do something when the status has been successfully updated
                    // For example, disable the button:
                    $(this).attr('disabled', 'disabled');
                    location.reload();
                }
            }.bind(this) // Bind the callback to the button
        });
    });
});
</script>

