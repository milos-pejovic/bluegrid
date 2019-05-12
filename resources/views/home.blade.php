<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>BlueGrid task</title>

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="edit-user-modal">
            <fieldset>
                <legend>Edit user:</legend>
                <form class="edit-user-form">
                    
                    <input type="text" name="id" class="id" style="display:none"/>
                    
                    <label>
                        Name
                        <input type="text" name="name" class="name" /> 
                    </label><br />

                    <label>
                        Email
                        <input type="text" name="email" class="email" /> 
                    </label><br />
                    <input type="submit" value="Update user" />
                </form>
            </fieldset>
        </div>
        
        <div>
             <fieldset>
                <legend>Create user:</legend>
                <form class="create-user-form">
                <label>
                    Name
                    <input type="text" name="name" class="name" /> 
                </label><br />
                
                <label>
                    Email
                    <input type="text" name="email" class="email" /> 
                </label><br />
                <input type="submit" value="Create user" />
            </form>
            </fieldset>
        </div>
        
        <hr />
        
        <div class="search">
            <fieldset>
                <legend>Search</legend>
                <form class="search-user-form">
                    <label>
                        Name
                        <input type="text" name="name" class="name" /> 
                    </label><br />

                    <label>
                        Email
                        <input type="text" name="email" class="email" /> 
                    </label><br />
                    <input type="submit" value="Search" />
                </form>
            </fieldset>
        </div>
        
        <div class="all-users-wrap">
            <h3 class="no-users">There are no users</h3>
            <table class="all-users" data-sorted-by="id" cellpadding="5px">
                <tr>
                    <th><a class="linkId sortingLink sortedBy" href="#">Id</a></th>
                    <th><a class="linkName sortingLink" href="#">Name</a></th> 
                    <th><a class="linkEmail sortingLink" href="#">Email</a></th>
                </tr>
            </table>
            
            <hr />
            
            <span>Results per page:</span><input class="result-per-page" type="number" min="1" value="10"/><br />
            <div class="pagination-links">
                
            </div>
        </div>
        
        <script src="{{ URL::to('js/main.js') }}"></script>
    </body>
</html>
