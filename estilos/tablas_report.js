// JavaScript Document
$(document).ready(function() {
   $("#striped tr:odd").addClass("stripes1");
   $("#striped tr:even").addClass("stripes2");
   
  $("#striped tr").hover(
  function(){$(this).toggleClass("stripes3")},
   function(){$(this).toggleClass("stripes3")}  
  
  );
   
    
});
   