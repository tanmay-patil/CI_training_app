$(window).on('load', function() {
    PROJECT_NAME = "CI3_Login_Demo";
    BASE_URL = window.location.origin + "/" + PROJECT_NAME + "/";
});

function logout() {
    $.ajax({
        type: 'POST',
        async: false,
        url: BASE_URL + "Login_controller/logout",
        success: function(response) {
            try {
                // Redirect to the login page
                window.location = BASE_URL;
            } catch (err) {
                console.log(err);
            }
        }
    });
}