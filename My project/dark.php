<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <style>
        body {
            padding: 25px;
            background-color: white;
            color: black;

        }

        .dark-mode {
            background-color: black;
            color: white;
        }

        /*button code*/

        .n{
            color: white;
            width: 150px;
            height: 50px;
            background-color: black;
            border-radius: 10px;
           
        }
      
        
    </style>
</head>

<body>

    <h class= "" onclick="myFunction()" id="button">dark mode</h>



    <script>
        function myFunction() {
            var element = document.body;
            element.classList.toggle("dark-mode");
        }


       
    </script>

</body>

</html>