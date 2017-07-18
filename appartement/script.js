var newTransaction = '\
<div id="nouvelleTransaction" title="Nouvelle transaction">\
  <p>Nouvelle transaction</p>\
</div>';

var dellTransaction = '\
<div id="dellTransaction" title="Supprimer transaction">\
  <p id="dellP"></p>\
</div>';

function addTransaction(){
  // $("#nouvelleTransaction").dialog('open');
}

var transactionId;
function deleteTransaction(id,date,title,amount){
  transactionId = id;
  // console.log(id);
  // console.log(date);
  // console.log(title);
  // console.log(amount);
  var dellP = "Etes vous sûr de vouloir supprimer la transaction '"+title+"' datant du "+date+"?";
  $("#dellP").html(dellP);
  $("#dellTransaction").dialog('open');
}

// $("#nouvelleTransaction").dialog('open');

var flatID;
function init(){
  flatID = $("#flatID").html();

  // $("#main").append(newTransaction);
  $("#main").append(dellTransaction);

  // $("#nouvelleTransaction").dialog({
  //   resizable: false,
  //   modal: true,
  // });

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

  // $("#nouvelleTransaction").dialog('close');
  $("#dellTransaction").dialog('close');

  refreshTransaction();
}

function refreshTransaction(){
    var table = $("#transactionsTable");
    table.html("");
    $.ajax("getTransactions.php?flat="+flatID)
      .done(function(data) {
        if(data == 0){
          // similar behavior as clicking on a link
          // window.location.href = "/";
        }
        else{
          table.html(data);
        }
      });
}
