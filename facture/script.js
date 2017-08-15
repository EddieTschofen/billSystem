function displayBill(id){
  alert(id);
}

function deleteSavedBill(id){
  alert(id);
  $.ajax("ajax/deleteSavedBill.php?id="+id)
    .done(function(data) {
      location.reload();
    });
}
