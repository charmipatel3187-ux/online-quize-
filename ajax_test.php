<!DOCTYPE html>
<html>

<head>

    <title>AJAX Test</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>

    <h1>AJAX Test</h1>

    <button id="loadMessage">
        Load Message
    </button>

    <p id="message"></p>


    <script>

        $(document).ready(function() {

            $("#loadMessage").click(function() {

                $.ajax({

                    url: "ajax_message.php",

                    type: "GET",

                    success: function(response) {

                        $("#message").html(response);

                    }

                });

            });

        });

    </script>

</body>

</html>