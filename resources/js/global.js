"use strict";

function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
            if(data.stat == 'Warning'){
                error(data.stat, data.message);
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        }
    });
}

// function deleteGlobal(id, title, url){
//     Swal.fire({
//         title: 'Are you sure want to delete ' + title + ' ?',
//         text: 'You won\'t be able to revert this!',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//     })
//     .then((willDelete) => {
//         if (willDelete.value) {
//             var csrf_token = $('meta[name="csrf-token"]').attr('content');
//             $.ajax({
//                 url : url + '/' + id,
//                 type : "POST",
//                 data : {'_method' : 'DELETE', '_token' : csrf_token},
//                 success : function(data) {
//                     table.ajax.reload();
//                     swal.fire({
//                         type: data.stat,
//                         title: 'Deleted',
//                         text: data.message,
//                     });
//                 },
//                 error : function () {
//                     swal.fire( {
//                         type: 'error',
//                         title: 'Oops...',
//                         text: 'Something went wrong!'
//                     });
//                 }
//             });
//         } else {
//             Swal.fire({
//                 type: 'success',
//                 title: 'Canceled',
//                 text: 'Your record is still safe!',
//             });
//         }
//     });
// }

