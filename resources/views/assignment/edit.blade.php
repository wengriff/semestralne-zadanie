
<tr hx-trigger='cancel' class='editing' hx-get="{{ route('assignment.edit', $assignmentSet->id) }}" hx-vals='{"_token": "{{ csrf_token() }}"}' >
<td>{{ $assignmentSet->id }}</td>
  <td><input type="date" name='starting_date' id='bStarting_date' value="{{ \Carbon\Carbon::parse($assignmentSet->starting_date)->format('Y-m-d') }}" data-original="{{ $assignmentSet->starting_date }}"></td>
  <td><input type="date" name='deadline' id='bDeadline' value="{{ \Carbon\Carbon::parse($assignmentSet->deadline)->format('Y-m-d') }}" data-original="{{ $assignmentSet->deadline }}"></td>
  <td><input type="number" name='points' id='bPoints'value="{{ $assignmentSet->points }}" data-original="{{ $assignmentSet->points }}"></td>
  <td>
    <button class="btn btn-danger" hx-get="{{ route('assignment.edit', $assignmentSet->id) }}" hx-vals='{"_token": "{{ csrf_token() }}"}' id="cancel-button" >
      Reset
    </button>
    <button class="btn btn-primary" hx-put="{{ route('assignment.update', $assignmentSet->id) }}" hx-include="closest tr" hx-vals='{"_token": "{{ csrf_token() }}"}'>
      Save
    </button>
  </td>
</tr>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const startingDateInput = document.getElementById('bStarting_date');
    const deadline = document.getElementById('bDeadline');
    const points = document.getElementById('bPoints');
    const cancelButton = document.getElementById('cancel-button');
    const startingDateInitialValue = startingDateInput.value;
    const deadlineInitialValue = deadline.value;
    const pointsInitialValue = points.value;

    cancelButton.addEventListener('click', function() {
        startingDateInput.value = startingDateInitialValue;
        deadline.value=deadlineInitialValue;
        points.value=pointsInitialValue;
    });
  });
</script>
