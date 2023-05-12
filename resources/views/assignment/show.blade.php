<tr>
                        <td>{{ $assignmentSet->id }}</td>
                        <td>{{ $assignmentSet->starting_date }}</td>
                        <td>{{ $assignmentSet->deadline }}</td>
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
          Edit
          </button>
      </td>
      </tr> 