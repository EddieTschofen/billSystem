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

//dellTransaction dialog content
var dellTransaction = '\
<div id="dellTransaction" title="Supprimer transaction">\
  <p id="dellP"></p>\
</div>';

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

var flatID;
function init(){
  flatID = $("#flatID").html();

  $("#main").append(newTransaction);
  $("#main").append(dellTransaction);
  $("#main").append(modifyTransaction);

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
          console.log("addTransaction.php?flat="+flatID+"&date="+date+"&title="+title+"&amount="+amount);
          $.ajax("addTransaction.php?flat="+flatID+"&date="+date+"&title="+title+"&amount="+amount)
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

  $( "#datepicker" ).datepicker({dateFormat: "yy/mm/dd"});
  $("#nouvelleTransaction").dialog('close');

  $("#dellTransaction").dialog({
      resizable: false,
      modal: true,
      buttons: {
        "Supprimer": function() {
          $.ajax("supprTransaction.php?id="+transactionId+"&flat="+flatID)
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
          $.ajax("editTransaction.php?flat="+flatID+"&date="+date+"&title="+title+"&amount="+amount+"&id="+transactionId)
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

  $( "#datepickerEdit" ).datepicker({dateFormat: "yy/mm/dd"});
  $("#editTransaction").dialog('close');

  refreshTransaction();
}

// clear and refresh the transactions table
function refreshTransaction(){
    var table = $("#transactionsTable");
    table.html("");
    $.ajax("getTransactions.php?flat="+flatID)
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
