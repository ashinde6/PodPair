$(document).ready(function() {
    // Prevent the form from submitting in the traditional way
    $('#searchForm').on('submit', function(event) {
        event.preventDefault();
        const search = $('#searchQuery').val().trim();
        if (search) {
            handleSearch(search);
        }
    });

    // Handle the click event on the search button
    $('#searchButton').click(function() {
        alert('Button clicked!');
        const search = $('#searchQuery').val().trim();
        if (search) {
            handleSearch(search);
        }
    });

    function handleSearch(search) {
        $.ajax({
            url: 'home.php', // Endpoint to handle the search
            method: 'GET', // HTTP method
            data: { searchQuery: search }, // Data to send in the request
            success: function(response) {
                $('#results').html(response); // Update results section
            },
            error: function(xhr, status, error) {
                $('#results').text("An error occurred. Please try again."); // Error message
            }
        });
    }
});




