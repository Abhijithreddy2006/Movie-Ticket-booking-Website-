$(document).ready(function() {
    let selectedSeats = [];

    $('.seat:not(.booked)').click(function() {
        $(this).toggleClass('selected');
        const seat = $(this).data('seat');
        
        if ($(this).hasClass('selected')) {
            selectedSeats.push(seat);
        } else {
            selectedSeats = selectedSeats.filter(s => s !== seat);
        }
        
        $('#selected_seats').val(selectedSeats.join(','));
        $('#book-btn').prop('disabled', selectedSeats.length === 0);
    });
}); 