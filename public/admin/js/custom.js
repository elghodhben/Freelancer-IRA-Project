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
          window.location="/delete-"+module+"/"+moduleid;
        }
      }) })
/*********update status USERS************ */


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










