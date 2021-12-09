//Wait for the DOM to load everytthing, jsust to be safe.
$(document).ready( function(){

  //Create our graph from the data table and specify a container to put the graph in

  createGrapgh('#data-table', '.chart');

  // Here be Graph

  function createGrapgh(data,container){
    // Declare some common varibles and container elements
    ...

    //Create the table data object
    var tableData = {
      ...
    }

    // Useful varibles to access table table
    ...

    // Set the individual height of bars
    function displayGraph(bars) {
      ...
    }

    // Reset the graphs settingd an prepare for display
    function resetGraph(){
      ...
      displayGraph(bars);
    }

    // Helper functions
    ...

    //Finally, display the graph via reset function
    resetGraph();
  }
});
// Declare some common variables and container elements
var bars = [];
var figureContainer = $('<div id="figure"></div>');
var graphContainer= $('<div class="graph"></div>');
var data= $(data);
var container= $(container);
var charData;
var vhartYMax;
var columnGroups;
// Timer variables
var barTimer;
var graphTimer;
