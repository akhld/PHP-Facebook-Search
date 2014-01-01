<?php

	if(isset($_POST['go'])){

		$access_token = $_POST['access_token'];

		$search_term = $_POST['search_term'];

		//echo $search_term;

		$url = "https://graph.facebook.com/search?access_token=" . $access_token . "&q=" . urlencode($search_term) . "&limit=500&type=post&locale=en_US";

		$fbJson = file_get_contents($url);

		//echo $fbJson;

		$dataArr = json_decode($fbJson,true);

		while($data = array_shift($dataArr)){

			foreach ($data as $item){

				if(array_key_exists('name',$item['from'])){
					//print_r($item['actions']);

					
					foreach($item['actions'] as $linked){
						//echo $linked['link'];
						$result .=  "<tr><td><a href=" . $linked['link'] .">". $item['from']['name'] . "</a><br>" . $item['message'] . "</td></tr>";

					}


				}



			}
		}

	}

?>


<html>

	<body>

		<center>
			<form method="POST" action="">
				<label>Access Tocken:</label><input type="text" name="access_token" style="width:600px;" value=<?php echo $access_token; ?> >
				<br/><br/>
				<label>Search Term:</label><input type="text" name="search_term">
				<input type="submit" value="Search" name="go">
			</form>

			<table border="1px;">
				<tr><td><center>Latest Posts</center></td></tr>
					<?php echo $result; ?>
			</table>

	
		</center>
	</body>

</html>