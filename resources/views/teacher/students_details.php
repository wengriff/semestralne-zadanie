<!-- Shows detailed information about student's equations-->
<x-app>
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <h2>{{ $student->name }} {{ $student->surname }}</h2>
    <table>
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