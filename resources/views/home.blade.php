<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>BlueGrid task</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    </head>
    <body>
        
        <button class="create-user-button">Create User</button>
        
        <div class="modal-wrap edit">
            <div class="edit-user-modal modal">
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
                        
                        <button type="submit">Update user <i class="fas fa-pencil-alt"></i></button>
                        <button class="cancel">Cancel <i class="far fa-times-circle"></i></button>
                    </form>
                </fieldset>
            </div>      
        </div>
        
        <div class="modal-wrap create">
            <div class="create-user-modal modal">
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
                    
                    <button type="submit">Create user <i class="fas fa-pencil-alt"></i></button>
                    <button class="cancel">Cancel <i class="far fa-times-circle"></i></button>
                </form>
                </fieldset>
            </div>
        </div>
        
        <div class="search">
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
            
            <span>Results per page:</span><input class="result-per-page" type="number" min="1" value="10"/><br />
            <div class="pagination-links">
                
            </div>
        </div>
        
        <script src="{{ URL::to('js/main.js') }}"></script>
    </body>
</html>
