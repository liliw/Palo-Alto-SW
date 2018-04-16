<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>r/Business</title>

  <link rel="stylesheet" type="text/css" href="index.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
</head>
    <body>
      <h1>r/Business</h1>
        <img class="directionCircle" alt="upCircle" src="img/upCircle.png"></img>
        <div class="col">
          <?php $class = new example(); $posts = $class->test(); foreach($posts as $key => $value): ?>
          <div class="panel">
            <div class="content">
              <h4> <?php echo $value[title]; ?>  </h4>
              <table class="info">
                <tr>
                  <td class="num-comments"><?php echo $value[num_comments].' comments'?></td>
                  <td class="author"><?php echo 'Submitted by '.$value[author] ?></td>
                  </tr>
              </table>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
        <img class="directionCircle" alt="downCircle" src="img/downCircle.png"></img>



      <?php

      	class example {
      		public function test() {
            error_reporting(E_ALL);
          	//ini_set('display_errors', 1);

          	$ch = curl_init();

          	curl_setopt($ch, CURLOPT_URL, 'https://www.reddit.com/r/business.json');
          	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          	curl_setopt($ch, CURLOPT_HEADER, 0);

          	$resp = curl_exec($ch);
          	if($resp === FALSE) {
          		echo "cURL Error: ", curl_error($ch);
          	}

          	curl_close($ch);

            $data = json_decode($resp,true);
            $children = $data[data][children];

            $posts = array();

            // append each post info in $posts
            foreach($children as $key => $value) {

              $info[title] = $value[data][title];
              $info[num_comments] = $value[data][num_comments];
              $info[author] = $value[data][author];
              $posts[$key] = $info;
              echo "<br>";
            }

            return $posts;

      		}
      	}



    ?>
  </body>
</html>
