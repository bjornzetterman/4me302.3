<?php
session_start();
if(!isset($_SESSION['userid']))
	die( "BAD LOGIN");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Visual analyze</title>
		<script src="https://d3js.org/d3.v3.js"></script>
				
		<style>
			body { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}

.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}
		</style>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jquery via CDN -->
    <script src="magic.js"></script> 
    </head>
    <body>
	  <?php echo "<div id='top'>Username:  " . $_SESSION['username'] ."(".$_SESSION['Role'].")" . " - E-mail:" . $_SESSION['email'] . "( ". $_SESSION['Organization'] . " ) <a href='logout.php'>Logout</a> <a href='javascript:history.back()'>Back one step to main</a></div>"; ?>
	  
	
        <script type="text/javascript">
			<?php
			if(isset($_GET['data'])){
			?>		
			var svg = d3.select("body").append("svg");
svg.attr("width", 500)
   .attr("height", 500)
     .append("g");
   
d3.csv("csvdata.php?data=<?php echo $_GET['data']; ?>", function(error, data){
  data.forEach(function(d) {
    d.X = +d.X;
	d.Y = +d.Y;
  });
//console.log(data[0]);
svg.selectAll(".dot")
      .data(data)
    .enter().append("circle")
      .attr("class", "dot")
      .attr("r", 2)
      .attr("cx", function(d) { return +d.X;})
      .attr("cy", function(d) { return +d.Y;});
	
})	

	
			
			<?php
				}
			?>				
        
        </script>
		  
	<form action="process.php" method="POST">
        <div id="message-group" class="form-group">
            <label for="message">Message</label>
            <input type="text" class="form-control" name="message" placeholder="Type your note here.">
            <!-- errors will go here -->
        </div>

        <button type="submit" class="btn btn-success">Submit note <span class="fa fa-arrow-right"></span></button>

    </form>
    </body>
</html> 