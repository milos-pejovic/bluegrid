var url = window.location.hostname;

var allUsersTable = $('.all-users');
var noUsersWarning = $('.no-users');
var paginationLinks = $('.pagination-links');
var sortByName = $('.all-users .linkName');
var sortByEmail = $('.all-users .linkEmail');
var sortById = $('.all-users .linkId');

// On page load

$(document).ready(function() {
    loadUsersWithAjax({
        params : {
            page : 0,
            limit : 10
        }
    });
});

// Load users

function loadUsersWithAjax(data) {
    var requestUrl = '/users';
    var parameters = [];
    
    if (data.params.page)
        parameters.push('page=' + data.params.page);
    
    if (data.params.limit)
        parameters.push('limit=' + data.params.limit);
    
    if (data.params.sortBy)
        parameters.push('sort_by=' + data.params.sortBy);
    
    if (parameters.length > 0) {
        requestUrl += '?' + parameters.join('&');
    }
    
    $.ajax({
	type: 'GET',
	url: requestUrl,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	success: function (result) {
            allUsersTable.show();
            noUsersWarning.hide();
            
            $('.user-table-entry').remove();
            $('.pagination-links').html('');
            
            if (result) {
                var numberOfResults = result.data.length; 
            } else {
                allUsersTable.hide();
                noUsersWarning.show();
                return;
            }
            
            // Results
            for (var i = 0; i < numberOfResults; i++){
                var entryHtml = '<tr class="user-table-entry id" data-id=' + result.data[i].id + '><td>';
                entryHtml += result.data[i].id + '</td>';
                entryHtml += '<td class="name">' + result.data[i].name + '</td>';
                entryHtml += '<td class="email">' + result.data[i].email + '</td>';
                entryHtml += '<td><button class="edit-user" data-id=' + result.data[i].id + '>Edit</button></td>';
                entryHtml += '<td><button class="delete-user" data-id=' + result.data[i].id + '>Delete</button></td>';
                entryHtml += '</tr>';
                allUsersTable.append(entryHtml);
            }
            
            // Pagination
            for (var j = 1; j <= result.last_page; j++) {
                
                if (j == result.current_page){
                    linkHtml = '<span class="current-page">';
                } else {
                    linkHtml = '<span>';
                }
                
                linkHtml += '<a class="pagination-link" href="#">';
                linkHtml += j;
                linkHtml += '</a>';
                linkHtml +=  '</span>';
                paginationLinks.append(linkHtml);
            }
	}
    });
}

// Load selected page

$('.pagination-links').delegate('.pagination-link', 'click', function() {
  var page = parseInt($(this).text());
  loadUsersWithAjax({
        params : {
            page : page,
            limit : parseInt($('.result-per-page').val()),
            sortBy : $('.all-users').attr('data-sorted-by')
        }
    });
});

// Sort by a value

function sortUserByValue(value) {
    var data = {};
    $('.sortingLink').removeClass('sortedBy');
    $('.all-users').attr('data-sorted-by', value); 
    data.params = {};
    data.params.sortBy = value;
    data.params.limit = parseInt($('.result-per-page').val());
    loadUsersWithAjax(data);
}

sortByName.on('click', function(e) {
    e.preventDefault();
    sortUserByValue('name');
    $(this).addClass('sortedBy');
});

sortByEmail.on('click', function(e) {
    e.preventDefault();
    sortUserByValue('email');
    $(this).addClass('sortedBy');
});

sortById.on('click', function(e) {
    e.preventDefault();
    sortUserByValue('id');
    $(this).addClass('sortedBy');
});

// Deleting a user

$('.all-users').delegate('.delete-user', 'click', function() {
    var userId = $(this).attr('data-id');
    
    if (!confirm('Delete user with ID ' + userId + '?')) {
       return;
    }
    
    deleteUserWithAjax(userId);
});

function deleteUserWithAjax(userId) {
    $.ajax({
        type: 'DELETE',
        url: '/users/' + userId,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	success: function(result) {
            $('.user-table-entry[data-id="' + userId + '"]').remove();
	}
    });
}

// Creating a user

$('.create-user-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    content = $(this).serialize();
    
    $.ajax({
	type: 'POST',
	url: '/users',
	data: content,
	dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	success: function(result) {
            var entryHtml = '<tr class="user-table-entry id" data-id=' + result + '><td>';
            entryHtml += result + '</td>';
            entryHtml += '<td class="name">' + form.find('input.name').val() + '</td>';
            entryHtml += '<td class="email">' + form.find('input.email').val() + '</td>';
            entryHtml += '<td><button class="edit-user" data-id=' + result + '>Edit</button></td>';
            entryHtml += '<td><button class="delete-user" data-id=' + result + '>Delete</button></td>';
            entryHtml += '</tr>';
            allUsersTable.append(entryHtml);
	}
    });
});

// Editing users

$('.all-users').delegate('.edit-user', 'click', function() {
  var editForm = $('.edit-user-modal');
  var userTableEntry = $(this).parents('.user-table-entry');
  
  editForm.find('.name').val(userTableEntry.find('.name').text());
  editForm.find('.email').val(userTableEntry.find('.email').text());
  editForm.find('.id').val(userTableEntry.attr('data-id'));
});

$('.edit-user-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    content = $(this).serialize();
    
    $.ajax({
	type: 'PATCH',
	url: '/users/' + $(this).find('.id').val(),
	data: content,
	dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	success: function(result) {
            var userTableEntry = $('.user-table-entry[data-id="'+result+'"]');
            userTableEntry.find('.name').text(form.find('input.name').val());
            userTableEntry.find('.email').text(form.find('input.email').val());
	}
    });
});
