var li="http://localhost/rad/";


//password changed
function PasswordChange(){
	$.ajax({
        type: "POST",
        url:li+'home/PasswordChange1',
      }).done (function(data) { 
           $("#PasswordChange1").html(data);
        }).fail (function()  {       
    });
}

function PasswordChange2(data){
	var passwordIn = $(data).val().trim();
	var hiddenSessionId = $('#hiddenSessionId').val().trim();
	//alert(hiddenSessionId);

	if (passwordIn != '' && hiddenSessionId != '') {
		$.ajax({
	        type: "POST",
	        url:li+'home/loginPassword2',
	        data: {passwordIn:""+passwordIn+"", hiddenSessionId:""+hiddenSessionId+""}
	      }).done (function(data) { 
	           $("#password2Result").html(data);
	        }).fail (function()  {       
	    });
	}
	
}
function passwordNewCon3(){
	var passwordNew = $('#passwordNew').val().trim();
	var passwordNewCon = $('#passwordNewCon').val().trim();

	if (passwordNew != '' || passwordNewCon != '') {
		if (passwordNew==passwordNewCon) {
			$passMass = document.getElementById('password3Result').innerHTML = '<span style="margin:5px 0;font-size:12px;color:green;display: block">password matched</span><button value="'+passwordNew+'" onclick="return submitPassword(this)" type="submit"class="btn btn-primary">Changed Password</button>';

		}else{
			document.getElementById('password3Result').innerHTML = '<div class="alert alert-warning">Password not matched</div>';
		}
	}
}
function submitPassword(data){
	var passwordNewCon = $(data).val().trim();
	//alert(passwordNew);

	$.ajax({
        type: "POST",
        url:li+'home/loginPassword3',
        data: {passwordNewCon:""+passwordNewCon+""}
      }).done (function(data) { 
           $("#password4Result").html(data);
        }).fail (function()  {       
    });
}
//change password end


function per_type(data){
	var id = $(data).val().trim();

	if(id == 0){


		$.ajax({
	        type: "POST",
	        url: li+"home/user_access",
	        data: {id:""+id+""}
	      }).done (function(data) { 
	           $('#per').html(data);
	        }).fail (function()  {       
	    });


	}else{
		$("#per").empty();
	}
}

function ttt(id){
	//alert(id);
	if(document.getElementById(id+"c").checked){

		$.ajax({
	        type: "POST",
	        url: li+"home/user_access_sub_menu",
	        data: {id:""+id+""}
	      }).done (function(data) { 
	           $("#"+id+"p").html(data);
	           document.getElementById("getsumitbutton").innerHTML='<button type="submit" class="btn btn-info">Confirm</button>';
	        }).fail (function()  {       
	    });

    }else{
    	$("#"+id+"p").empty();
	    document.getElementById("getsumitbutton").innerHTML='';
    }


}

$("#showPass").click(function(){
		
	if($(this).is(":checked")){
		$("#passShowId").attr('type','text');
	}
	else{			
		$(".#passShowId").attr('type','password');
	}
});


//####### allsubcategory
function allsubcategory(){
	var menuid = $("#allsubcategory_menuid").val().trim();

	if (!menuid=='') {
		//alert(menuid);
		$.ajax({
	        type: "POST",
	        url: li+"home/allsubcategory",
	        data: {menuid:""+menuid+""}
	      }).done (function(data) { 
	           $('#allsubcategory_show').html(data);
	        }).fail (function()  {       
	    });

	}else{
		$("#allsubcategory_show").empty();
	}
	
}

function changecathp(data){
	var id = $(data).val().trim();
	$.ajax({
        type: "POST",
        url: li+"home/changecathp",
        data: {id:""+id+""}
      }).done (function(data) { 
           location.reload();
        }).fail (function()  {       
    });
}

function changecathpp(data){
	var id = $(data).val().trim();
	$.ajax({
        type: "POST",
        url: li+"home/changecathpp",
        data: {id:""+id+""}
      }).done (function(data) { 
           location.reload();
        }).fail (function()  {       
    });
}
function changeProducthp(data){
  var id = $(data).val().trim();
  $.ajax({
        type: "POST",
        url: li+"home/changeProducthp",
        data: {id:""+id+""}
      }).done (function(data) { 
           location.reload();
        }).fail (function()  {       
    });
}


//product category to sub category
function selectcategory(data){
	var catid = $(data).val().trim();
	if (catid !='') {
        $.ajax({
            type: "POST",
            url: li+"home/cat_to_subcat",
            data: {catid:  ""+catid+""}
        }).done (function(data) {
              if (data) { 
                $("#showsubcategory").html(data);
                return true;
              }
          }).fail (function()  {       
        });
    }else{
        $("#showsubcategory").empty();
    }
}


//fer admin panel


function changeCoustomerStatus(data){
	var status = $(data).val().trim();
	$.ajax({
        type: "POST",
        url: li+"home/changeCoustomerStatus",
        data: {status:""+status+""}
      }).done (function(data) { 
           location.reload();
           //alert('Verified');
        }).fail (function()  {       
    });
}

function changeOrderStatus(data){
  var status = $(data).val().trim();
  $.ajax({
        type: "POST",
        url: li+"home/changeOrderStatus",
        data: {status:""+status+""}
      }).done (function(data) { 
           location.reload();
           alert('Order Verified');
        }).fail (function()  {       
    });
}

function createbill(data){
	var orderid = $(data).val().trim();
	$.ajax({
        type: "POST",
        url: li+"home/createbill",
        data: {orderid:""+orderid+""}
      }).done (function(data) { 
           //location.reload();
           $(".createbillresult").html(data);
        }).fail (function()  {       
    });
}
function vatchange(){
  var vat = $("#vatchange").val().trim();
    $.ajax({
        type: "POST",
        url: li+"home/vatchange",
        data: {vat:""+vat+""}
      }).done (function(data) { 
           if (data) {
            alert(data);
            return true;
           }else{
            alert('vat changing failed');
            return false;
           }
        }).fail (function()  {       
    });
}
function billstatus(data){
  var bstatus = $(data).val().trim();


  var explode = bstatus.split(":");
  var sohel = explode[1];


  $.ajax({
        type: "POST",
        url: li+"home/billstatus",
        data: {bstatus:""+bstatus+""}
      }).done (function(data) { 
           if (data !=2) {

            //alert(data);
            $("#statusbill"+sohel).html(data);
            return true;
           }else if (data==2) {}{
            $("#hide"+sohel).fadeOut(data);
            return false;
           }
        }).fail (function()  {       
    });
}
function deletedorder(data){
  var orderid = $(data).val().trim();
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
        type: "POST",
        url: li+"home/deletedorder",
        data: {orderid:""+orderid+""}
      }).done (function(data) { 
           if (data) {
            alert(data);
            $(".iddeess"+orderid).fadeOut();
            return true;
           }else{
            alert('Order Deleted failed');
            return false;
           }
        }).fail (function()  {       
    });
  }
}


//edit,delete,update works start
function delcontact(data){
  var delid = $(data).val().trim();
  var alerts = confirm("Are you dure to delete !");
  if (alerts == 1) {
    
    $.ajax({
      type: 'POST',
      url:li+'home/delcontact',
      data:{delid:delid},
      dataType:'json',
      success: function(response){
        $("#delc"+delid).fadeOut();
      },
      error: function(){
        alert('Error deleting.');
      }
    });


  }
}
function editcontact(data){
  var eid = $(data).val().trim();

  $.ajax({
    type: 'POST',
    url:li+'home/editcontact',
    data:{eid:eid},
    dataType:'json',
    success: function(response){
      
      $('#replymessage').html(response);
    },
    error: function(){
      alert('Error reply.');
    }
  });

}
function ReplyMessages(){
  var conTo = $("#conTo").val().trim();
  var conFrom = $("#conFrom").val().trim();
  var conSubject = $("#conSubject").val().trim();
  var conMessage = $("#conMessage").val().trim();

  if (!conTo=='' && !conFrom=='' && !conSubject=='') {

      $.ajax({
        type: 'POST',
        url:li+'home/ReplyMessages',
        data:{conTo:conTo,conFrom:conFrom,conSubject:conSubject,conMessage:conMessage},
        dataType:'json',
        success: function(response){          
          alert(response);
        },
        error: function(){
          alert('Error reply.');
        }
      });

  }else{
    alert('Information incomplete !');
  }
}

function delcoustomer(data){
  var delid = $(data).val().trim();
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
      type: 'POST',
      url:li+'home/delcoustomer',
      data:{delid:delid},
      dataType:'json',
      success: function(response){
        if (response) {
          $("#"+delid+"delco").fadeOut();
        }else{
          alert("Delete Failed");
        }
          
      },
      error: function(){
        alert('Error Deleting');
      }
    });
  }

}

function deleteproduct(data){
  var delid = $(data).val().trim();
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
      type: 'POST',
      url:li+'home/deleteproduct',
      data:{delid:delid},
      dataType:'json',
      success: function(response){
        if (response) {
          $("#"+delid+"delpro").fadeOut();
        }          
      },
      error: function(){
        alert('Deleting');
      }
    });
  }

}




//coustomer panel website
function registercous(){
  var name = $("#cousname").val().trim();
  var email = $("#cousemail").val().trim();
  var password = $("#couspassword").val().trim();
  var mobile = $("#cousmobile").val().trim();
  var address = $("#cousaddress1").val().trim();

  var address2 = $("#cousaddress2").val().trim();
  var zip = $("#cousZip").val().trim();
  var city = $("#couscity").val().trim();
  if (name !='' && email !='' && password !='' && mobile !='' && address !='') {
    $.ajax({
            type: "POST",
            url: li+"main/coustomeraccount",
            data: {name:""+name+"",email:""+email+"",password:""+password+"",mobile:""+mobile+"",address:""+address+"",address2:""+address2+"",zip:""+zip+"",city:""+city+""}
        }).done (function(data) {
              if (data) {
                alert(data);
                location.reload();                 
                //window.location= li+'main/invoice';
                return true;
              }
          }).fail (function()  {       
        });
  }else{
    alert("Information Incomplete...");
  }
}
function addtopshop(data){
  var pid = $(data).val().trim();
  var id = 'addedText'+pid;
  

  $.ajax({
    type: 'POST',
    url:li+'main/addtopshop',
    data:{pid:pid},
    dataType:'json',
    success: function(response){
      $("#items").html(response);
      document.getElementById(id).innerHTML = "ADDED";
    },
    error: function(){
      alert('Error Shop Adding');
    }
  });

}
function addtopshopDetails(){  
  var pid = $("#productpid").val().trim();
  var name = $("#productname").val().trim();
  var color = $("#productcolor").val().trim();
  var size = $("#productsize").val().trim();
  var quantity = $("#productquantity").val().trim();
  var price = $("#productprice").val().trim();
  if (quantity !='0' && pid !=='' && quantity !== '') {
  

      $.ajax({
        type: 'POST',
        url:li+'main/addtopshopDetails',
        data:{pid:pid,name:name,color:color,size:size,quantity:quantity,price:price,},
        dataType:'json',
        success: function(response){
          $("#items").html(response);
          document.getElementById("detailsPro").innerHTML = "ADDED";
        },
        error: function(){
          alert('Error Shop Adding');
        }
      });


  }else{
    alert("Information incomplete.");
  }

}

$(function(){
  cartshow();

  function cartshow(){
    $.ajax({
      type: 'POST',
      url:li+'main/cartshow',
      dataType:'json',
      success: function(data){

        $("#items").html(data);
        
      },
      error: function(){
        //alert('Could not get from Database');
        //location.reload();
      }
    });
  }

});

function cartdetailsshow(){
  $.ajax({
    type: 'POST',
    url:li+'main/cartdetailsshow',
    dataType:'json',
    success: function(data){

      var html = '';
      var i;
      var SL = 1;
      var sum = 0;
      for(i=0; i<data.length;i++){
        var pid = data[i].pid;
        var id = data[i].id;
        var name = data[i].name;
        var price = data[i].price;
        var quantity = data[i].quantity;
        var Total = data[i].total;


        html += 
        '<tr class="'+id+'del">'+
          '<td>'+SL+++'</td>'+
          '<td><img src="'+li+'assest/images/product/'+pid+'.jpg" alt="Product Image"  width="40" height="50"/></td>'+
          '<td>'+name+'</td>'+
          '<td><span id="'+id+'quntd">'+quantity+'</span></td>'+
          '<td><span id="'+id+'pricetd">'+price+'</span> Tk.</td>'+
          '<td><span id="'+id+'totaltd">'+Total+'</span> Tk.</td>'+
          '<td><button class="btn btn-sm btn-default qun_add" data="'+id+'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>'+
          '<td><button class="btn btn-sm btn-default qun_sub" data="'+id+'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td>'+
          '<td><button class="btn btn-sm btn-danger cart_del" data="'+id+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'+
        '</tr>'
        ;
      }
      $('#mnshowCart').html(html);
      
    },
    error: function(){
      alert('Could not get from Database');
    }
  });
}
$('#mnshowCart').on('click', '.qun_add', function(){
  var proid =$(this).attr('data');

  $.ajax({
    type: 'POST',
    url:li+'main/cartupdate',
    data:{proid:proid},
    dataType:'json',
    success: function(data){
      var i;
      for(i=0; i<data.length;i++){
        var price = data[i].price;
        var quantity = data[i].quantity;
        var Total = data[i].total;


        $("#"+proid+"quntd").html(quantity);
        $("#"+proid+"totaltd").html(Total);

      }
    },
    error: function(){
      alert('Could not get from Database');
    }
  });
});
$('#mnshowCart').on('click', '.qun_sub', function(){
  var proid =$(this).attr('data');

  $.ajax({
    type: 'POST',
    url:li+'main/cartupdate_sub',
    data:{proid:proid},
    dataType:'json',
    success: function(data){
      var i;
      for(i=0; i<data.length;i++){
        var price = data[i].price;
        var quantity = data[i].quantity;
        var Total = price*quantity;


        $("#"+proid+"quntd").html(quantity);
        $("#"+proid+"totaltd").html(Total);

      }
    },
    error: function(){
      alert('Could not get from Database');
    }
  });
});

$('#mnshowCart').on('click', '.cart_del', function(){
  var cid =$(this).attr('data');
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
      type: 'POST',
      url:li+'main/cartdeleted',
      data:{cid:cid},
      dataType:'json',
      success: function(response){
        $("."+cid+"del").fadeOut();
          $("#items").html(response);  
      },
      error: function(){
        alert('Error Deleting');
      }
    });
  }

});

function deleteorderlist(data){
  var cid = $(data).val().trim();
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
      type: 'POST',
      url:li+'main/cartdeleted',
      data:{cid:cid},
      dataType:'json',
      success: function(response){
        $("#"+cid+"del").fadeOut();
          $("#items").html(response);  
      },
      error: function(){
        alert('Error Deleting');
      }
    });
  }
}
function hadcashPay(data){
  var sesid = $(data).val().trim();
  if (sesid !='') {
    $.ajax({
            type: "POST",
            url: li+"main/hadcashPay",
            data: {sesid:""+sesid+""}
        }).done (function(data) {
              if (data) { 
                alert(data);
                window.location=li+'main/order','_blank';
                return true;
              }
          }).fail (function()  {       
        });
  }else{
    alert("Failed.");
  } 
}
function BcashPay(data){
  var sesid = $(data).val().trim();
  var payment = $("#paymenttraxtid").val().trim();
  if (sesid !='' && payment !='') {
    $.ajax({
            type: "POST",
            url: li+"main/BcashPay",
            data: {sesid:""+sesid+"",payment:""+payment+""}
        }).done (function(data) {
              if (data) {
                alert(data);
                window.location= li+'main/order';
                return true;
              }
          }).fail (function()  {       
        });
  }else{
    alert("Please input BKash TraxId...");
  } 
}
function sendcontact(){
  var name = $("#cname").val().trim();
  var email = $("#cemail").val().trim();
  var subject = $("#csubject").val().trim();
  var message = $("#cmessage").val().trim();
  if (name !='' && email !=='' && subject !== '' && message !== '') {
    $.ajax({
            type: "POST",
            url: li+"main/sendcontact",
            data: {name:""+name+"",email:""+email+"",subject:""+subject+"",message:""+message+""}
        }).done (function(data) {
              if (data) { 
                alert(data);
                location.reload();
                return true;
              }
          }).fail (function()  {       
        });
  }else{
    alert("Information incomplete.");
  }
}





/*=======admin panel===========*/
function userstatus(data){
  var editg = $(data).val().trim();
  
  $.ajax({
        type: "POST",
        url: li+"home/userstatus",
        data: {editg:""+editg+""}
      }).done (function(data) { 
           location.reload();
        }).fail (function()  {       
    });
}
function userdel(data){
  var delid = $(data).val().trim();
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
          type: "POST",
          url: li+"home/userdel",
          data: {delid:""+delid+""}
        }).done (function(data) { 
             $('#delu'+delid).fadeOut(data);
          }).fail (function()  {       
     });
  }
}

function editsubcategories(value){
  var id = $(value).val().trim();
    $.ajax({
        type: "POST",
        url: li+"home/editsubcategories",
        data: {id:""+id+""}
      }).done (function(data) { 
           $("#showcategoryup").html(data);
        }).fail (function()  {       
    });
}
function editcategories(value){
  var id = $(value).val().trim();
    $.ajax({
        type: "POST",
        url: li+"home/editcategories",
        data: {id:""+id+""}
      }).done (function(data) { 
           $("#showcategoryup").html(data);
        }).fail (function()  {       
    });
}
function delcategory(data){
  var delid = $(data).val().trim();
  var alerts = confirm("Are you dure to delete !");
  if (alerts == 1) {
    
    $.ajax({
      type: 'POST',
      url:li+'home/delcategory',
      data:{delid:delid},
      dataType:'json',
      success: function(response){
        $("#delccat"+delid).fadeOut();
      },
      error: function(){
        alert('Error deleting.');
      }
    });


  }
}