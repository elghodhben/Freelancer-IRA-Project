$(document).on("click",".confirmDelete",function(){
    var module = $(this) .attr('module');
   var moduleid = $(this) .attr('moduleid');
 //  alert(module);
 //  return false;
    Swal.fire({

        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location="/admin/delete-"+module+"/"+moduleid;
        }
      }) })
/*********update status section************ */


$(document).on("click",".updateUserStatus",function(){
    var  status= $(this).children("i").attr("status");
    var user_id=$(this).attr("user_id");
  // alert(user_id);
    $.ajax({
      headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'post',
      url:'update-user-status',
      data:{status:status,user_id:user_id},

      success:function(resp){
        location.reload();
        },error:function(){
           alert ('error');
       }
  })

  });







/****************check  */
$(document).ready(function(){
$("#current_password").keyup(function(){

  var current_password= $("#current_password").val();

  //alert(current_password)
  $.ajax({
      type:'post',
      url:'/check-admin-password',
      data:{current_password:current_password},

      success:function(resp){
         if(resp=="false"){
           $("#check_password").html("<font color='red'>actuel mot de passe invalide </font>");
      } else if (resp=="true"){
           $("#check_password").html("<font color='green'>actuel mot de passe valide </font>");}
       },error:function(){
          alert ('error');
      }
  });

})
})



