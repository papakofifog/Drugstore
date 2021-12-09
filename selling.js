// When the user clicks the search input box abox container should appear.
function doSearch(){
  // get the id of the search container
  var searchData =document.getElementById('searchCon');
  // get the id of the search input box
  var inpuSearchdata= document.getElementById('inpuSearch');
// get the current display setting of the search box;
  var displaySeting=searchData.style.display;
// toggle the visibility of the search data box
  if(displaySeting== "none"){
    //set the input box to hidden
    inpuSearchdata.style.display="hidden";
    // box is not displyed change it to displayed.
    searchData.style.display="block";

  }else {
    // clock is displyed
    searchData.style.display="none"
  }
}
function search(){
  var input = document.getElementById("searchCon");
  input.submit();
}

function creatID(){
  let value= Math.random()*100;
  var newID= "Asante"+value;
  return newID;
}

function SetID(){
  var elementID= document.getElementById(setID);
  elementID.id=creatID();
}
function drugIcrease(){

  var num=0;

}
function showDrugIncrease(){
  // get the current ID of  the Add button on the Drugssoldtoday.php
  var increaseButton= document.getElementById('Add25700');
  // get the id for the container to display when  the add button is clickecd on.
  var incContainer = document.getElementById('incdrug275');
  // get the current display setting of the  Increase drug display.
  var incButn=incContainer.style.display;
  // if the the Add Drug button is clicked. Display the container to increase the drugs in stock.

  if(incButn="none"){
    console.log('We are seeing something');
    // set the input box to hidden
    increaseButton.style.display= 'hidden';
    // if the container is not been displayed
    incContainer.style.display='block';
  }else {
    incContainer.style.display='none';
  }
}
