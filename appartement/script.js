//on add transaction button
function addTransaction(){
  emptyNewTransactionDialog();
  $("#nouvelleTransaction").dialog('open');
}

//on dell transaction button
var transactionId;
function deleteTransaction(id,date,title,amount){
  transactionId = id;
  // console.log(id + " " + date + " " + title + " " + amount);
  var dellP = "Etes vous sûr de vouloir supprimer la transaction '"+title+"' datant du "+date+" ?";
  $("#dellP").html(dellP);
  $("#dellTransaction").dialog('open');
}

function editTransaction(id,date,title,amount){
  transactionId = id;
  // alert(id);
  // console.log(id + " " + date + " " + title + " " + amount);

  $("#err").removeClass("err");
  $("#datepickerEdit")[0].value = date;
  $("#titleEdit")[0].value = title;
  $("#amountEdit")[0].value = Math.abs(amount);
  if(amount<0){
    $("#payableEdit")[0].checked = false;
    $("#paymentEdit")[0].checked = true;
  }else{
    $("#payableEdit")[0].checked = true;
    $("#paymentEdit")[0].checked = false;
  }
  $("#editTransaction").dialog('open');

}

// clear and refresh the transactions table
function refreshTransaction(){
    var table = $("#transactionsTable");
    table.html("");
    $.ajax(localURL+"ajax/getTransactions.php?flat="+flatID)
      .done(function(data) {
        if(data === 0){
          // similar behavior as clicking on a link
          window.location.href = "/";
        }
        else{
          table.html(data);
        }
      });
}

function emptyNewTransactionDialog(){
  $("#err").removeClass("err");
  $("#datepicker")[0].value = "";
  $("#title")[0].value = "";
  $("#amount")[0].value = "";
  $("#payable")[0].checked = false;
  $("#payment")[0].checked = false;
}

function createBill(){
  $("#newBill").dialog('open');
}

var flatID;
var localURL;
function init(){
  flatID = $("#flatID").html();
  localURL = window.location.href.indexOf("?")>0 ? "" : "../";
  initAdd();
  initDell();
  initEdit();
  initBill();
  refreshTransaction();

  // createBill();
}

//newTransaction dialog content
var newTransaction = '\
<div id="nouvelleTransaction" title="Nouvelle transaction">\
  <fieldset>\
    <table>\
      <tr><td><label>Date : </label> </td><td><input type="text" id="datepicker"></tr>\
      <tr><td><label>Titre : </label></td><td> <input type="text" name="title" id="title" value=""></tr>\
      <tr><td><label>Montant : </label></td><td> <input type="number" min="0" name="amount" id="amount" value=""></tr>\
      <tr><td colspan=2><input type="radio" id="payable" name="transactionType" value="creance"> \
      Créance <input type="radio" id="payment" name="transactionType" value="payment"> Paiement</tr>\
    </table>\
    <p style="padding-top:10px;margin:0px;" id="err">Tous les champs sont obligatoire</p>\
  </fieldset>\
</div>';
function initAdd(){
  $("#main").append(newTransaction);
  $("#nouvelleTransaction").dialog({
    resizable: false,
    modal: true,
    buttons: {
      "Ajouter": function() {
        var date = $("#datepicker")[0].value;
        var title = $("#title")[0].value;
        var amount = $("#amount")[0].value;
        var payable = $("#payable")[0].checked;
        var payment = $("#payment")[0].checked;
        if(payment) amount = -1*(amount);
        // console.log(date + " " + title + " " + amount + " payable : " + payable + " payment : " + payment);
        if(date != "" && title != "" && amount != "" && (payable || payment)){
          $.ajax(localURL+"ajax/addTransaction.php?flat="+flatID+"&date="+date+"&title="+title+"&amount="+amount)
            .done(function(data) {
              if(data){
                refreshTransaction();
              }
            });

          emptyNewTransactionDialog();
          $( this ).dialog( "close" );
        }
        else $("#err").addClass("err");
      },
      "Annuler": function() {
        emptyNewTransactionDialog();
        $( this ).dialog( "close" );
      }
    }
  });

  $( "#datepicker" ).datepicker({dateFormat: "dd/mm/yy"});
  $("#nouvelleTransaction").dialog('close');
}

//dellTransaction dialog content
var dellTransaction = '\
<div id="dellTransaction" title="Supprimer transaction">\
  <p id="dellP"></p>\
</div>';
function initDell(){
  $("#main").append(dellTransaction);
  $("#dellTransaction").dialog({
      resizable: false,
      modal: true,
      buttons: {
        "Supprimer": function() {
          $.ajax(localURL+"ajax/supprTransaction.php?id="+transactionId+"&flat="+flatID)
            .done(function(data) {
              if(data){
                refreshTransaction();
              }
            });

          $( this ).dialog( "close" );
        },
        "Annuler": function() {
          $( this ).dialog( "close" );
        }
      }
    });

  $("#dellTransaction").dialog('close');
}

//editTransaction dialog content
var modifyTransaction = '\
<div id="editTransaction" title="Editer transaction">\
  <fieldset>\
    <table>\
      <tr><td><label>Date : </label> </td><td><input type="text" id="datepickerEdit"></tr>\
      <tr><td><label>Titre : </label></td><td> <input type="text" name="title" id="titleEdit" value=""></tr>\
      <tr><td><label>Montant : </label></td><td> <input type="number" min="0" name="amount" id="amountEdit" value=""></tr>\
      <tr><td colspan=2><input type="radio" id="payableEdit" name="transactionType" value="creance"> \
      Créance <input type="radio" id="paymentEdit" name="transactionType" value="payment"> Paiement</tr>\
    </table>\
    <p style="padding-top:10px;margin:0px;" id="errEdit">Tous les champs sont obligatoire</p>\
  </fieldset>\
</div>';
function initEdit(){
  $("#main").append(modifyTransaction);
  $("#editTransaction").dialog({
    resizable: false,
    modal: true,
    buttons: {
      "Editer": function() {
        var date = $("#datepickerEdit")[0].value;
        var title = $("#titleEdit")[0].value;
        var amount = $("#amountEdit")[0].value;
        var payable = $("#payableEdit")[0].checked;
        var payment = $("#paymentEdit")[0].checked;
        if(payment) amount = -1*(amount);
        // console.log(date + " " + title + " " + amount + " payable : " + payable + " payment : " + payment);
        if(date != "" && title != "" && amount != "" && (payable || payment)){
          // console.log("editTransaction.php?flat="+flatID+"&date="+date+"&title="+title+"&amount="+amount+"&id="+transactionId);
          $.ajax(localURL+"ajax/editTransaction.php?flat="+flatID+"&date="+date+"&title="+title+"&amount="+amount+"&id="+transactionId)
            .done(function(data) {
              if(data){
                refreshTransaction();
              }
            });

          emptyNewTransactionDialog();
          $( this ).dialog( "close" );
        }
        else $("#errEdit").addClass("err");
      },
      "Annuler": function() {
        $( this ).dialog( "close" );
      }
    }
  });

  $( "#datepickerEdit" ).datepicker({dateFormat: "dd/mm/yy"});
  $("#editTransaction").dialog('close');
}

var newBillForm = '\
<div id="newBill" title="Nouvelle facture">\
  <fieldset>\
    <form id="generateBill" action="bill.php" target="_blank">\
      <table>\
        <tr><td colspan ="2"><label>Numéro d\'avis d\'échéance : </label>  <input name="billNumber" type="number" min="0" id="num"></tr>\
        <tr><td><label>Periode du : </label><br/><label>  au : </label></td><td width="200px"><input name="startPeriode" type="text" id="datepickerBill1"><br/><input name="endPeriode" type="text" id="datepickerBill2"></tr>\
      </table>\
      <div class="invisible">\
        <input type="text" name="ownerName" id="ownerName" value="">\
        <input type="text" name="ownerAddress" id="ownerAddress" value="">\
        <input type="text" name="ownerZip" id="ownerZip" value="">\
        <input type="text" name="ownerCity" id="ownerCity" value="">\
        <input type="text" name="ownerPhone" id="ownerPhone" value="">\
        <input type="text" name="ownerCell" id="ownerCell" value="">\
        <input type="text" name="ownerMail" id="ownerMail" value="">\
        \
        <input type="text" name="bankName" id="bankName" value="">\
        <input type="text" name="ownerIBAN" id="ownerIBAN" value="">\
        <input type="text" name="ownerBIC" id="ownerBIC" value="">\
        \
        <input type="text" name="flatNumber" id="flatNumber" value="">\
        \
        <input type="text" name="tenantName" id="tenantName" value="">\
        <input type="text" name="tenantAddress" id="tenantAddress" value="">\
        <input type="text" name="tenantZip" id="tenantZip" value="">\
        <input type="text" name="tenantCity" id="tenantCity" value="">\
        <input type="text" name="tenantPhone" id="tenantPhone" value="">\
        \
        <input type="text" name="stillToPay" id="stillToPay" value="">\
        \
        <input type="text" name="rentalID" id="rentalID" value="">\
        \
        <div id="detailsList"></div>\
      </div>\
      <p style="padding-top:10px;margin:0px;" id="errBill">Tous les champs sont obligatoire (date de fin posterieur a la date de début)</p>\
      <br/>\
      Commentaires : <a id="commentInfo" href="#" title=""><img width=8px src="/appartement/img/questionMark.svg.png"/></a><br/>\
      <textarea rows="6" cols="43" name="comment"></textarea> <br/>\
      Information paiement client : <a id="paymentInfo" href="#" title=""><img width=8px src="/appartement/img/questionMark.svg.png"/></a><br/>\
      <textarea rows="6" cols="43" name="paymentInfo"></textarea> <br/>\
      \
      <label><input type="checkbox" name="save" value="1"> Sauvegarder la facture ?</label><br/>\
    </form>\
  </fieldset>\
</div>';
function initBill(){
  $("#main").append(newBillForm);

  $("#newBill").dialog({
    resizable: false,
    modal: true,
    buttons: {
      "Editer": function() {
        var numBill = $("#num")[0].value;
        var startDate = $("#datepickerBill1")[0].value;
        var endDate = $("#datepickerBill2")[0].value;
        // console.log($("#datepickerBill1").datepicker("getDate") + " " + $("#datepickerBill2").datepicker("getDate") + " " + $("#datepickerBill1").datepicker("getDate") < $("#datepickerBill2").datepicker("getDate"));
        if(numBill != "" && startDate != "" && endDate != "" && ($("#datepickerBill1").datepicker("getDate") < $("#datepickerBill2").datepicker("getDate"))){

          var url = localURL+"ajax/getInfo.php?login="+$("#login").text()+"&flat="+flatID+"&dateStart="+startDate+"&dateEnd="+endDate;
          console.log("localhost/appartement/"+url);
          $.ajax(url)
            .done(function(data) {
              if(data){
                var result = data.split('|');
                $("#ownerName").val(result[0]);
                $("#ownerAddress").val(result[1]);
                $("#ownerZip").val(result[3]);
                $("#ownerCity").val(result[2]);
                $("#ownerPhone").val(result[5]);
                $("#ownerCell").val(result[6]);
                $("#ownerMail").val(result[4]);

                $("#bankName").val(result[7]);
                $("#ownerIBAN").val(result[8]);
                $("#ownerBIC").val(result[9]);

                $("#flatNumber").val($("#flatNum").html());

                $("#tenantName").val($("#legendName a").html());
                $("#tenantAddress").val($("#tenantAddressSpan").html());
                $("#tenantZip").val($("#tenantZipSpan").html());
                $("#tenantCity").val($("#tenantCitySpan").html());
                $("#tenantPhone").val($("#tenantPhoneSpan").html());

                $("#stillToPay").val(result[10]);

                var i2 = result[11];
                var inputs = ""
                var newI;
                for(var i = 0;i<i2;i++){
                  // console.log(i);
                  inputs += '<input type="type" name="date'+i+'" value="'+result[12+i*3]+'">';
                  inputs += '<input type="type" name="name'+i+'" value="'+result[13+i*3]+'">';
                  inputs += '<input type="type" name="amount'+i+'" value="'+result[14+i*3]+'">';

                  newI = 14+i*3+1;
                }

                $("#rentalID").val(result[newI]);

                // console.log(inputs);
                $("#detailsList").append(inputs);
                $("#generateBill").submit();
                $("#detailsList").html("");
                $("#errBill").removeClass("err");
              }
            });

          $( this ).dialog( "close" );
        }
        else $("#errBill").addClass("err");
      },
      "Annuler": function() {
        $( this ).dialog( "close" );
        $("#errBill").removeClass("err");
      }
    }
  });

  $("#num")[0].value = 170740;
  $("#datepickerBill1")[0].value = "01/06/2017";
  $("#datepickerBill2")[0].value = "31/06/2017";

  $( "#datepickerBill1" ).datepicker({dateFormat: "dd/mm/yy"});
  $( "#datepickerBill2" ).datepicker({dateFormat: "dd/mm/yy"});
  $( '#commentInfo' ).tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true,
    content: 'Le contenue sera situé ici : <br/><img width=250px src="img/comment.png" />'
  });
  $( '#paymentInfo' ).tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true,
    content: 'Le contenue sera situé ici : <br/><img width=250px src="img/paiement.png" />'
  });
  $("#newBill").dialog('close');
}
