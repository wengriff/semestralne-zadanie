//TODO test for similar amounts if the second order by surname works
$(document).ready(function() {
    $('#studentTable').DataTable({
        searching: false,
        lengthChange: false,
        pagingType: 'simple',
        order: [],
        columnDefs: [
            {
                targets: [0, 1 ,2, 3, 4, 5],  
                orderable: true,
                orderData: [0, 2], //second order by second column
            },
        ],
    });
});

