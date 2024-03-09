// pagination for function
function pagination(totalpages, currentpages) {
    // console.log("TOTAL PAGES", totalpages)6
    // console.log(currentpages)9
    var pagelist = "";
    if (totalpages > 1) {
        currentpages = parseInt(currentpages);
        pagelist += `<ul class="pagination justify-content-center"> `;
        const prevClass = currentpages == 1 ? "disabled" : "";
        pagelist += `<li class="page-item ${prevClass} "><a class="page-link" href="#" data-page=" ${currentpages - 1}">Previous</a></li>`;
        for (let p = 1; p <= totalpages; p++) {
            const activeClass = currentpages == p ? "active" : "";
            pagelist += `<li class="page-item ${activeClass} "> <a class="page-link" href="#" data-page="${p}" > ${p} </a></li> `;
        }

        const nextClass = currentpages == totalpages ? "disabled" : "";

        pagelist += `<li class="page-item ${nextClass} "><a class="page-link" href="#" data-page="${currentpages + 1}">Next</a></li>`;
        pagelist += `</ul>`;
    }
    $("#pagination").html(pagelist);

}




// user create krne ka functions kaha hai


// function to get users from data base   
function getuserrow(user) {
    var userRow = "";
    if (user) {
        userRow = `  <tr>
        <td scope="row"><img src=uploads/${user.photo}></td>
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td>${user.mobile}</td>
        <td>
            <a href="#" class="mr-3 profile" data-target="#userViewModal" data-toggle="modal" title="view profile" data-id=${user.id}> <i class="fas fa-eye text-success"></i></a>
            <a href="#" class="mr-3 edituser" data-target="#usermodal" data-toggle="modal" title="Edit" data-id=${user.id}><i class="fas fa-edit text-info"></i></a>
            <a href="#" class="mr-3 deleteuser" title="Delete" data-id=${user.id}><i class="fas fa-trash-alt text-danger"></i></a>

        </td>

    </tr>`;
    };
    return userRow;
}




// insert kaha se horhe?


// get users function 
function getusers() {
    var pageno = $("#currentpage").val();
    $.ajax({
        url: "/newproject/ajax.php",
        type: "GET",
        dataType: "json",
        data: { page: pageno, action: 'getallusers' },
        beforeSend: function () {
            // console.log("waiting"); 4
        },
        success: function (rows) {
            // console.log(rows);3
            if (rows) {
                var userslist = "";
                //   console.log(rows);
                $.each(rows.users, function (index, user) {
                    userslist += getuserrow(user);
                });
                // console.log(users);
                $("#usertable tbody").html(userslist)

                let totaluser = rows.count;
                // console.log(totaluser);2
                let totalpages = Math.ceil(parseInt(totaluser) / 4);
                const currentpages = $("#currentpage").val();
                pagination(totalpages, currentpages);


            }

        },
        error: function () {

            console.log("Oops! something went wrong!");
        },
    });
}



// loading document 

$(document).ready(function () {
    // adding user
    // alert(2);

    //  jquery wala issue thk hogya hai ab doosra issue hai woh check kro ok bro
    //sai insert to hgia ha bhai ok hai

    $(document).on("submit", "#addform", function (event) {
        event.preventDefault();
        var msg = ("#userid").length > 0 ? 
        "user has been updated successfully" : "new user has been added successfully";
        // ajax
        $.ajax({
            url: "/newproject/ajax.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                console.log("wait...Data is loading");

            },
            success: function (response) {
                // console.log(response);
                if (response) {
                    $("#usermodal").modal("hide");
                    $("#addform")[0].reset();
                    $(".displaymessage").html(msg).fadeIn().delay(3000).fadeOut();
                    getusers()
                }
            },
            error: function () {
                console.log("Oops! something went wrong!");
            },
        });
    });



    // onclick event function 
    $(document).on("click", "ul.pagination li a", function (event) {
        event.preventDefault();
        const pagenum = $(this).data("page");
        $("#currentpage").val(pagenum);
        getusers();
        $(this).parent().siblings().removeClass("active");
        $(this).parent().addClass("active");


    })

    // onclick event for editing
    $(document).on("click", "a.edituser", function () {
        var uid = $(this).data("id");
        // alert(uid); 
        $.ajax({
            url: "/newproject/ajax.php",
            type: "GET",
            dataType: "json",
            data: { id: uid, action: "editusersdata" },
            beforeSend: function () {
                console.log("waiting");
            },
            success: function (rows) {
                // console.log(rows); 1
                if (rows) {
                    $("#username").val(rows.name);
                    $("#email").val(rows.email);
                    $("#mobile").val(rows.mobile);
                    $("#userid").val(rows.id);

                }

            },
            error: function () {

                console.log("Oops! something went wrong!");
            },
        });
    })

    //onclick for aditing user btn
    $("#adduserbtn").on("click", function () {
        $("#addform")[0].reset();
        $("#userid").val("");
    })

    //  onclick event for deleting 
    $(document).on("click", "a.deleteuser", function (e) {
        e.preventDefault();
        var uid = $(this).data("id");
        if (confirm("Are you sure ? You want to delete")) {

            $.ajax({
                url: "/newproject/ajax.php",
                type: "GET",
                dataType: "json",
                data: { id: uid, action: "deleteuser" },
                beforeSend: function () {
                    // console.log("waiting");
                },
                success: function (res) {
                    if (res.delete == 1) {
                        $(".displaymessage")
                            .html("user deleter succesfully?")
                            .fadeIn()
                            .delay(3000)
                            .fadeOut();
                        getusers();
                        // console.log("done");
                    }
                },
                error: function () {

                    console.log("Oops! something went wrong!");
                },

            })
        };

    })

    // profile view 

    $(document).on("click", "a.profile", function () {
        var uid = $(this).data("id");
        $.ajax({
            url: "/newproject/ajax.php",
            type: "GET",
            dataType: "json",
            data: { id: uid, action: "editusersdata" },
            success: function (user) {
                if (user) {
                    const profile = `
               <div class="row">
                   <div class="col-sm-6 col-md-4">
                   <img src=uploads/${user.photo} alt="Image" class="rounded">
       
                   </div>
                   <div class="col-sm-6 col-md-8">
                   <h4 class="text-primary"> ${user.name}</h4>
                         <p>
                           <i class="fas fa-envelope-open text-dark"></i>${user.email}
                           <br>
                           <i class="fas fa-phone text-dark"></i>${user.mobile}
                         </p>
                   </div>
               </div>`;
                    $("#profile").html(profile);
                }
            }, error: function () {

                console.log("Oops! something went wrong!");
            },

        });
    });

    // search data bs  yaha id add krni thi searchbar ki aur yeh kal bhi kaha tha tumhe
    $("#searchuser").on("keyup", function () {
        const searchText = $(this).val();
        // console.log("ON SEARCHBAR : ", searchText)   

        if (searchText.length > 1) {
            $.ajax({
                url: "/newproject/ajax.php",
                type: "GET",
                dataType: "json",
                data: { searchQuery: searchText, action: "searchuser" }, //bhai ,mme yaha ki thi
                success: function (users) {
                    // console.log(users);
                    //   alert(2);

                    if (users) {
                        var userslist = "";
                        $.each(users, function (index, user) {
                            userslist += getuserrow(user);
                        });
                        $("#usertable tbody").html(userslist);
                        $("#pagination").hide();

                    }
                }, error: function () {

                    console.log("Oops! something went wrong!");
                },
            })
        } else {
            getusers();
            $("#pagination").show();


        }
    })



    // alert(10);
    //calling getusers() funtion when document is loaded;
    getusers();

    // end 
});