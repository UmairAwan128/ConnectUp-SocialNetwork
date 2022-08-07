$(".hidePost").click(function() {
  debugger;
  $(this)
    .parents(".hideThisPost")
    .fadeOut("slow");
});

// $(".call").click(function(e) {
//   e.preventDefault(); // prevent form from reloading page
//   alert("hiii");

//   $.ajax({
//     url: "localhost:8080/blah/blah/blah",
//     type: "GET",
//     beforeSend: function() {
//       alert(1);
//     },
//     error: function() {
//       alert("Error");
//     },
//     success: function(data) {
//       if (data == "success") {
//         alert("request sent!");
//       }
//     }
//   });
// });
