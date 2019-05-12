var url = window.location.hostname;

var allUsersTable = $('.all-users');
var noUsersWarning = $('.no-users');
var paginationLinks = $('.pagination-links');
var sortByName = $('.all-users .linkName');
var sortByEmail = $('.all-users .linkEmail');
var sortById = $('.all-users .linkId');
//var resultsPerPage = parseInt($('.result-per-page').val());

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
	success: function (result) {
            allUsersTable.show();
            noUsersWarning.hide();
            
            console.warn(result);
            return;
            
            if (result) {
                var numberOfResults = result.data.length; 
            } else {
                // todo
            }
            
            // Results
            for (var i = 0; i < numberOfResults; i++){
                var entryHtml = '<tr class="user-table-entry"><td>';
                entryHtml += result.data[i].id + '</td>';
                entryHtml += '<td>' + result.data[i].name + '</td>';
                entryHtml += '<td>' + result.data[i].email + '</td>';
                entryHtml += '<td><button>Edit</button></td>';
                entryHtml += '<td><button>Delete</button></td>';
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
                
                linkHtml += '<a href="#">';
                linkHtml += j;
                linkHtml += '</a>';
                linkHtml +=  '</span>';
                paginationLinks.append(linkHtml);
            }
            
	}
    });
}

// Sort by a value

function sortUserByValue(value) {
    $('.user-table-entry').remove();
    var data = {};
    data.params = {};
    data.params.sortBy = value;
    data.params.limit = parseInt($('.result-per-page').val());
    loadUsersWithAjax(data);
}

sortByName.on('click', function(e) {
    e.preventDefault();
    sortUserByValue('name');
});

sortByEmail.on('click', function(e) {
    e.preventDefault();
    sortUserByValue('email');
});

sortById.on('click', function(e) {
    e.preventDefault();
    sortUserByValue('id');
});

// On page load
$(document).ready(function() {
    loadUsersWithAjax({
        params : {
            page : 0,
            limit : 10
        }
    });
});

