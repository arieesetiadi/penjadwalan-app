// $(function () {
//     // Url user search API
//     let url = $("#url-user-search").attr("content");

//     ajaxHeader();

//     // Ketika user typing
//     $("#input-user-search").on("input", function () {
//         // Ambil user key
//         let key = $(this).val();

//         $.ajax({
//             url: url,
//             data: { key: key },
//             method: "POST",
//             success: (users) => showUsers(users),
//         });
//     });
// });

// function showUsers(users) {
//     let strUsersTabel = null;
//     console.log(users);

//     if (users.length > 0) {
//         strUsersTabel = `
//             <table id="users-table" class="table align-middle">
//                 <thead>
//                     <tr>
//                         <th>#</th>
//                         <th></th>
//                         <th>Nama</th>
//                         <th>Username</th>
//                         <th>Email</th>
//                         <th>Telepon</th>
//                         <th>Jenis Kelamin</th>
//                         <th>Divisi</th>
//                         <th>Tipe</th>
//                         <th>Aksi</th>
//                     </tr>
//                 </thead>
//                 <tbody>
//         `;

//         users.forEach((user, i) => {
//             strUsersTabel += `
//                 <tr>
//                     <td>${i + 1}</td>
//                     <td>${user.name}</td>
//                     <td>${user.username}</td>
//                     <td>${user.email}</td>
//                     <td>${user.phone}</td>
//                     <td>${user.gender}</td>
//                     <td>${user.division.name}</td>
//                     <td>${user.role.name}</td>
//                 </tr>
//             `;
//         });

//         strUsersTabel += `
//                 </tbody>
//             </table>
//         `;
//     } else {
//         strUsersTabel = `
//             <thead>
//                 <h6 class="text-center">Pengguna tidak ditemukan.</h6>
//             </thead>
//         `;
//     }

//     console.log(strUsersTabel);
// }

// function ajaxHeader() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $("#csrf-token").attr("content"),
//         },
//     });
// }
