<div class="container content">

	<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE) { ?>
		<!-- QSO Number Alert - Make some QSOs -->
		<div class="alert alert-success">
			You have had <strong><?php echo $todays_qsos; ?></strong> QSOs Today!
		</div>
	<?php } ?>
	
	<!-- Generate JS for Map -->
	<script type="text/javascript">
	  function create_map() {
	  
		<?php if($qra == "set") { ?>
		var latlng = new google.maps.LatLng(<?php echo $qra_lat; ?>, <?php echo $qra_lng; ?>);	
		<?php } else { ?>
		var latlng = new google.maps.LatLng(40.313043, -32.695312);
		<?php } ?>
	  
		var myOptions = {
		  zoom: 3,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var infowindow = new google.maps.InfoWindow();

		var marker, i;

		/* Get QSO points via json*/
		 $.getJSON("<?php echo site_url('dashboard/map'); ?>", function(data) {
			
			$.each(data.markers, function(i, val) {
				/* Create Markers */
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(this.lat, this.lng),
					map: map
				});
				
				/* Store Popup Text */
				var content = this.html;
			
				/* Create Popups */
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(content);
						infowindow.open(map, marker);
					}
				})(marker, i));
			});
		 });

		var map = new google.maps.Map(document.getElementById("map"),
			myOptions);
	  }

		$(document).ready(function(){
			create_map();
	  });
	</script>
	
	<!-- Output Google Map showing QSOs -->
	<div id="map" style="width: 100%; height: 300px"></div>
	
	<div class="row">
		<div class="span8">
			<table width="100%" class="table table-striped">
				<tr class="titles">
					<td>Date</td>
					<td>Time</td>
					<td>Call</td>
					<td>Mode</td>
					<td>Sent</td>
					<td>Recv</td>
					<td>Band</td>
				</tr>

				<?php $i = 0; 
				foreach ($last_five_qsos->result() as $row) { ?>
					<?php  echo '<tr class="tr'.($i & 1).'">'; ?>
						<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('d/m/y', $timestamp); ?></td>
						<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('H:i', $timestamp); ?></td>
						<td><a class="qsobox" href="<?php echo site_url('logbook/view')."/".$row->COL_PRIMARY_KEY; ?>"><?php echo strtoupper($row->COL_CALL); ?></a></td>
						<td><?php echo $row->COL_MODE; ?></td>
						<td><?php echo $row->COL_RST_SENT; ?> <?php if ($row->COL_STX_STRING) { ?><span class="label"><?php echo $row->COL_STX_STRING;?></span><?php } ?></td>
						<td><?php echo $row->COL_RST_RCVD; ?> <?php if ($row->COL_SRX_STRING) { ?><span class="label"><?php echo $row->COL_SRX_STRING;?></span><?php } ?></td>
						<?php if($row->COL_SAT_NAME != null) { ?>
						<td><?php echo $row->COL_SAT_NAME; ?></td>
						<?php } else { ?>
						<td><?php echo $row->COL_BAND; ?></td>
						<?php } ?>
					</tr>
				<?php $i++; } ?>
			</table>
		</div>
		
		<div class="span4">
			<table width="100%" class="table table-striped">
				<tr class="titles">
					<td colspan="2"><span class="icon_stats">QSOs</span></td>
				</tr>
				
				<tr>
					<td>Total </td>
					<td><?php echo $total_qsos; ?></td>
				</tr>
				
				<tr>
					<td>Year</td>
					<td><?php echo $year_qsos; ?></td>
				</tr>

				<tr>
					<td>Month</td>
					<td><?php echo $month_qsos; ?></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
				</tr>
				
				<tr class="titles">
					<td colspan="2"><span class="icon_world">Countries</span></td>
				</tr>
				
				<tr>
					<td>Worked</td>
					<td><?php echo $total_countrys; ?></td>
				</tr>
				
				<tr>
					<td>Needed</td>
					<td><?php $dxcc = 340 - $total_countrys; echo $dxcc; ?></td>
				</tr>
				
				<tr>
					<td></td>
					<td></td>
				</tr>
						
				<tr class="titles">
					<td colspan="2"><span class="icon_qsl">QSL Cards</span></td>
				</tr>
				
				<tr>
					<td>Sent</td>
					<td><?php echo $total_qsl_sent; ?></td>
				</tr>
						
				<tr>
					<td>Received</td>
					<td><?php echo $total_qsl_recv; ?></td>
				</tr>
				
				<tr>
					<td>Requested</td>
					<td><?php echo $total_qsl_requested; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>