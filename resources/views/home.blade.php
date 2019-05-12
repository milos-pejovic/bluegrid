<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BlueGrid task</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="all-users-wrap">
            <h3 class="no-users">There are no users</h3>
            <table class="all-users">
                <tr>
                    <th><a class="linkId" href="#">Id</a></th>
                    <th><a class="linkName" href="#">Name</a></th> 
                    <th><a class="linkEmail" href="#">Email</a></th>
                </tr>
            </table>
            <span>Results per page:</span><input class="result-per-page" type="number" min="1" value="15"/><br />
            <div class="pagination-links">
                
            </div>
        </div>
        
        <script src="{{ URL::to('js/main.js') }}"></script>
    </body>
</html>
