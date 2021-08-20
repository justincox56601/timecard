<?php
get_template_part('header');
?>
<div class="hero-col">
	<div class="add-new-client">
		<h2> Add New Clients</h2>
		<form action="<?php echo URLROOT?>/timecards/addNewClient" method="post">
		<div>
			<input type="text" name="clientName" id="clientName" placeholder="Client Name*">
		</div>
		<div>
			<input type="email" name="contactEmail" id="contactEmail" placeholder="Contact Email*">
		</div>
		<div>
			<input type="number" name="rate" id="rate" value='25'>
		</div>
		
		<input type="submit" value="Submit">

		</form>
		
	</div>
	<div class="timecard-container">
		<h2>Enter Hours Worked</h2>
		<form action="<?php echo URLROOT?>/timecards/postWork" method="POST">
			<div>
				<select name="clientName" id="clientName">
				<option value="null">Select a Client</option>
				<?php
					foreach($data['clients'] as $client){
						echo "<option value=" . $client->id . ">" . $client->name . "</option>";
					}

				?>
				</select>
			</div>
			<div>
				<textarea name="description" id="description" cols="30" rows="10">Description*</textarea>
			</div>
			<div>
				<p>Start Time</p>
				<input type="datetime-local" name="starttime" id="starttime" >
			</div>
			<div>
				<p>End Time</p>
				<input type="datetime-local" name="endtime" id="endtime" >
			</div>
			<div>
				<input type="submit" value="Submit">
			</div>
		</form>
		
	</div>
	<div class="unbilled-work">
		<h2>Get unbilled work</h2>
		<form action="<?php echo URLROOT?>/timecards/getWork" method="get">
		<div>
			<select name="clientId" id="clientId">
			<option value="null">Select a Client</option>
			<?php
				foreach($data['clients'] as $client){
					echo "<option value=" . $client->id . ">" . $client->name . "</option>";
				}

			?>
			</select>
			</div>	
			<input type="submit" value="Submit">
		</form>
		<div>
			<pre>
				<?php
				if(isset($data['clientWork'])){
					print_r($data['clientWork']);
				}
				?>
			</pre>
			
		</div>
	</div>
	<div class="data-container">
		<pre>
			<?php print_r($data);?>
		</pre>
		
	</div>
</div>
<?php
get_template_part('footer');
