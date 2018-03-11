// function changeBlock(select) {
//   var id = select.selectedIndex;
//   id = select.selectedItem.value;
//   console.log(id);
//   // document.getElementById("detail_"+select.selectedIndex).style.display = "initial";
// }

var id;
$('#blockSelect').change(function(){
    try{$(id).css("display","none");} catch(e){}

    if($(this)[0].selectedIndex == 1){
      id = "#newBlockForm";
    }
    else{
      id = "#detail_"+($(this).val());
    }
    console.log(id);
    $(id).css("display","block");
});

var form;
function validateForm(){
  try {
      form = document.forms['newFlat'];
      // console.log(form);
      if (form["block"].selectedIndex == 0)
          return false
      else if (form["block"].selectedIndex == 1) {
          if (form["name"].value == "" || form["address"].value == "" || form["city"].value == "" || form["zip"].value == "") return false;
      }
      else {
          if (form["flatNum"].value == "")
              return false;
          else {
              var flats = document.getElementsByClassName("blocksFlat")[$('#blockSelect').prop('selectedIndex') - 2].innerHTML;
              var ind = flats.indexOf(form["flatNum"].value);
              if(!ind) return false;
          }
      }
      return true;
  } catch(e) {console.log(e); return false;}
}
