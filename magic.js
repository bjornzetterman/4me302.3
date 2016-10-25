// magic.js
$(document).ready(function() {
    // process the form
    $('form').submit(function(event) {
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
           
            'message'    : $('input[name=message]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // use POST
            url         : 'process.php', // the backend we send the form data to
            data        : formData, // the data
            dataType    : 'json', // we want json from the backend script, in return.
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {
                // log data to the console so developers can see
                console.log(data); 
                // maybe add something about erromesages/feedback data from server
            });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
