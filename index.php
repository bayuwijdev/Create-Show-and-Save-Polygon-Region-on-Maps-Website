<?php 
	include("lib_func.php");
	
    $coords = null;
    $link=koneksi_db();
    $nomor_rfid_anggota='12345678';
    
    	$sql="SELECT * FROM lahan_petani where nomor_rfid_anggota = '$nomor_rfid_anggota'
          ORDER BY kode_lahan";
		$res=mysql_query($sql,$link); 
		$banyakrecord=mysql_num_rows($res);
		if($banyakrecord > 0) {
			
			while ($row=mysql_fetch_array($res)) {
				$data = $row['points'];
				$luas_lahan = $row['luas_lahan'];
				preg_match_all('/\((.*?)\)/', $data, $matches);
         
		        $coords = $matches[1];
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Coba Save Region on Maps to Database</title>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&sensor=false"></script>
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="polygon.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
	$(function(){
		  //create map
		 var garutCikandangCenter=new google.maps.LatLng(-7.3752001, 107.7391782);
		 var myOptions = {
		  	zoom: 10,
		  	center: garutCikandangCenter,
		  	mapTypeId: google.maps.MapTypeId.ROADMAP
		  }
		 map = new google.maps.Map(document.getElementById('main-map'), myOptions);
		 
		 var creator = new PolygonCreator(map);		 

		 // set polygon data to the form hidden field
         $('#map-form').submit(function () {
            $('#map-coords').val(creator.showData());
         });


	         <?php if (null!=$coords): ?>
	          // create
	         var polygonCoords = [<?php
	                                foreach ( $coords as $i=>$coord ):
	                                    echo 'new google.maps.LatLng('.$coord.')';
	                                    if ( $i<=count($coords)) {
	                                     echo ',';
	                                    }
	                                endforeach;?>];
	 
	         // construct the polygon
	         polygon = new google.maps.Polygon({
	                               paths: polygonCoords,
	                               strokeColor: "#FF0000",
	                               strokeOpacity: 0.8,
	                               strokeWeight: 2,
	                               fillColor: "#FF0000",
	                               fillOpacity: 0.35
	         });
	 
	         // show polygon on the map
	         polygon.setMap(map);
	         
	         var infowindow = new google.maps.InfoWindow({
	                    content: 'Luas Lahan : <?php echo "$luas_lahan"; ?>'
	               });
	         		// Menambahkan event Click pada marker
	               google.maps.event.addListener(polygon, 'click', function() {		
	               		// Memanggil 'open method' InfoWindow
		               	infowindow.open(map, polygon);
		               });
	               
	         <?php endif;?>


		 //reset
		 $('#reset').click(function(){ 
		 		creator.destroy();
		 		creator=null;
		 		
		 		creator=new PolygonCreator(map);
		 });		 
		 
		 //show paths
		 $('#showData').click(function(){ 
		 		$('#dataPanel').empty();
		 		if(null==creator.showData()){
		 			$('#dataPanel').append('Please first create a polygon');
		 		}else{
		 			$('#dataPanel').append(creator.showData());
		 		}
		 });
		 
		 //show color
		 $('#showColor').click(function(){ 
		 		$('#dataPanel').empty();
		 		if(null==creator.showData()){
		 			$('#dataPanel').append('Please first create a polygon');
		 		}else{
		 				$('#dataPanel').append(creator.showColor());
		 		}
		 });


	});	
	</script>
</head>
<body>
	<div style="margin:auto;  width: auto; ">
		<div id="main-map" style="height: 500px;">
		</div>
		<center>
			<form action="index.php" method="POST" id="map-form">         
	            <input type="hidden" name="coords" id="map-coords" value=""/>
	            <label>Luas Lahan</label>
	            <input type="text" name="luas_lahan" id="luas_lahan"></input>
	            <br><input type="submit" value="Save"/>             
	            <input type="reset" value="Reset"/>
	        </form>
		</center>
	</div>
	<div id="side">
		<input id="reset" value="Reset Marker Polygon" type="button" class="navi"/>
		<input id="showData"  value="Show Paths (class function) " type="button" class="navi"/>
		<div   id="dataPanel">
		</div>
	</div>
	<?php 
		if (!empty($_POST)) {
	        $luas_lahan=$_POST['luas_lahan'];
	        $coordinats=$_POST['coords'];
	        $nomor_rfid_anggota='12345678';
	    	echo "$luas_lahan <br>";
	    	echo "$coordinats";
	    	$save_lahan = mysql_query("INSERT INTO lahan_petani VALUES('','$nomor_rfid_anggota','$coordinats','$luas_lahan')",$link);
	    	if ($save_lahan) {
	    		
	    		?> 
			      <script type='text/javascript'>
			              window.alert('Data lahan berhasil disimpan!')
			      </script>
			      <script>document.location='index.php'</script>
			    <?php
			    }
			    else {
			      
			    ?> 
			      <script type='text/javascript'>
			              window.alert('Terjadi kesalahan dalam penyimpanan data lahan dengan kesalahan <?php echo mysql_error($link);?>. Silahkan diulang lagi!<br>')
			            </script>
			            <script>document.location='index.php'</script>
			    <?php
			    }
	    	
	    } 
	 ?>
</body>
</html>