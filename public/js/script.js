//datepicker
$('#datepicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).datepicker;










// // plugin summernote WYSIWYG editor
// $(document).ready(function () {
//     $('#content').summernote();
// });

// // alert animation
// $("#alert").delay(4000).slideUp(200, function () {
//     $(this).alert('close');
// });

// // ajax search
// $('#search-article').on('keyup', function () {
//     $.ajax({
//         url: '/article',
//         type: 'GET',
//         dataType: 'json',
//         data: {
//             'search': $('#search-article').val()
//         },
//         success: function (data) {
//             $('#article-list').html(data['view']);
//             console.log(data);
//         },
//         error: function (xhr, status) {
//             console.log(xhr.eror + 'ERROR STATUS : ' + status);
//         },
//         complete: function () {
//             alreadyloading = false;
//         }
//     });
// });

// // komentar ajax
// $('#btn-comment').on('click', function (e) {
//     e.preventDefault();
//     $.ajax({
//         url: '/comments',                                   // !!! ini adalah url tujuan dimana controller akan melakukan logikanya jk button di click {dlm kasus ini, '/comments' adalah uri dr route name 'comments.store', jd akan msk k 'CommentsController@store'}
//         type: 'POST',
//         dataType: 'json',
//         data: $('#form-comment').serialize(),               // !!! CARA BARU -->> cara ambil value dr input form dgn select id form nya lalu gunakan method 'serialize()' !!!
//         // data: {                                          // CARA LAMA
//         //     '_token': $('input[name=_token]').val(),
//         //     'article_id': $('#article_id').val(),
//         //     'user': $('#user').val(),
//         //     'comment': $('#comment').val()
//         // },
//         success: function (data) {
//             // cari elemen dgn id list-komentar dan lakukkan innerHtml dgn isi data['view]
//             $('#list-komentar').html(data['view']);
//             // kosongkan isis elemen dgn id user & comment
//             $('#user').val('');
//             $('#comment').val('');
//             // fokus k elemen dgn id user
//             $('#user').focus();
//             console.log(data);
//         },
//         error: function (xhr, status, data) {
//             if (data.status === 422) {
//                 var errors = data.responseJSON;
//                 $.each(data.responseJSON, function (key, value) {
//                     $('#comment').html(value['comment']);
//                 });
//             }
//             console.log(xhr.eror + 'ERROR STATUS : ' + status);
//         },
//         complete: function () {
//             alreadyloading = false;
//         }
//     });
// });


// // REST API
// // detail movie - REST API
// $('#movie-list').on('click', '#see-detail', function () {
//     $.ajax({
//         url: 'https://api.themoviedb.org/3/movie/' + $(this).data('id'),            // !!! "$(this).data('id')" ngambil isi dr atribut "data-id" dr object yg d klik
//         type: 'GET',
//         dataType: 'json',
//         data: {
//             'api_key': '3ec1ae76b8cf857f3494ab325a8d304a',
//             'language': 'en-US'
//         },
//         success: function (movie) {
//             // cari elemen html dgn id "modal-label" dan ganti isi html nya
//             $('#modal-label').html(movie.title + ' <sub>Detail</sub>');
//             // cari elemen html dgn class "modal-body" dan ganti isi html nya
//             $('.modal-body').html(`
//                 <div class="container-fluid">
//                     <div class="row">
//                         <div class="col-md-4">
//                             <img src="https://image.tmdb.org/t/p/w500` + movie.poster_path + `" class="img-fluid">
//                         </div>
//                         <div class="col-md-8">
//                             <ul class="list-group">
//                                 <li class="list-group-item"><h3>` + movie.title + `</h3></li>
//                                 <li class="list-group-item"><b>Released : </b>` + movie.release_date + `</li>
//                                 <li class="list-group-item"><b>Genre : </b>
//                                     <span class="badge badge-pill badge-primary">` + movie.genres['0'].name + `</span>
//                                     <span class="badge badge-pill badge-primary">` + movie.genres['1'].name + `</span> 
//                                     <span class="badge badge-pill badge-primary">` + movie.genres['2'].name + `</span> 
//                                 </li>
//                                 <li class="list-group-item"><b>Budget : </b>` + movie.budget + `</li>
//                                 <li class="list-group-item"><b>Rating : </b>` + movie.vote_average + `</li>
//                             </ul>
//                         </div>
//                     </div>
//                     <div class="row mt-3">
//                         <div class="col-md-12">
//                             <ul class="list-group">
//                                 <li class="list-group-item"><b>Plot : </b>` + movie.overview + `</li>
//                             </ul>
//                         </div>
//                     </div>
//                 </div>
//             `);
//         }
//     })
// });