<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>國立中正大學高齡研究基地</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
		<div id="body">
			<div id="content">
				<?php
                    if(isset($_GET['article_id'])){
                        $article_id = $_GET['article_id'];
                        $clean_article_id = $purifier->purify($article_id);
                        $clean_article_id = mysql_real_escape_string($clean_article_id);
                        $article = mysql_query("select * from articles where id like '$clean_article_id'");
                        if(mysql_num_rows($article) == 0) {
                            ?>
                            <div id="path"><a href="index.php"><img src="./images/icon_home.jpg" alt="回首頁" width="11" height="10" hspace="10" border="0" align="absmiddle" /></a>
            &nbsp;&#8250;&nbsp;<a href='activity2.php'>活動訊息</a></div>
                            <h1>查無此資料</h1>
                            <?php
                        }
                        else {
                            $article_content = mysql_fetch_assoc($article);
                            $author_id = $article_content['author_id'];
                            $user = mysql_query("select * from members where id like '$author_id'");
                            $user_content = mysql_fetch_assoc($user);
                            $name = $user_content['name'];
                            $account = $user_content['account'];
                            $title = $article_content['title'];
                            $content = $article_content['content'];
                            $ary_phase = array("\r\n","\r","\n");
                            $content = str_replace($ary_phase,'<br />',$content);
                            $content = str_replace('<R>','<span style="color:red;">',$content);
                            $content = str_replace('</R>','</span>',$content);
                            $content = str_replace('<B>','<span style="color:blue;">',$content);
                            $content = str_replace('</B>','</span>',$content);
                            $content = str_replace('<G>','<span style="color:green;">',$content);
                            $content = str_replace('</G>','</span>',$content);
                            $content = str_replace('<Strong>','<span style="font-weight:bold;">',$content);
                            $content = str_replace('</Strong>','</span>',$content);
                            $content = str_replace('<Link="','<a target="_blank" href="',$content);
                            $content = str_replace('</Link>','</a>',$content);
                            $time = $article_content['created_time'];
                    ?>
                    <div id="path"><a href="index.php"><img src="./images/icon_home.jpg" alt="回首頁" width="11" height="10" hspace="10" border="0" align="absmiddle" /></a>
            &nbsp;&#8250;&nbsp;<a href='activity2.php'>近期活動</a>&nbsp;&#8250;&nbsp;<a href='news2.php?article_id=<?php echo $clean_article_id?>'><?php echo $title; ?></a>
                    </div>
                    <h1><?php echo $title; ?></h1>
                    <!--<span><?php echo $name; ?> 於 <?php echo $time; ?> 上傳</span>-->
                    <p><?php echo $content; }?></p>
                    <br/><br/><br/>
                    <a href="activity2.php" class="button">返回</a>
                    <?php }
                    else {
                    ?>
                    <div id="path"><a href="index.php"><img src="./images/icon_home.jpg" alt="回首頁" width="11" height="10" hspace="10" border="0" align="absmiddle" /></a>
            &nbsp;&#8250;&nbsp;<a href='activity2.php'>近期活動</a>
                    </div>
                    <h1>近期活動</h1>
                    <ul>
                    <?php
                        $article = mysql_query("select * from articles where article_type='3' order by year desc, month desc, day desc");
                        $num = mysql_num_rows($article);
                        if($num == 0){
                            ?>
                            <li style="list-style-type:none;padding-top: 8px;padding-bottom: 8px;"><a href="#" style="text-decoration:none;color:#f6a837;font-weight:bold;">目前尚無資料</a></li>
                            <?php
                        }
                        else{
                            for($i=1;$i<=mysql_num_rows($article);$i++){
                            $article_content = mysql_fetch_assoc($article);
                            $type = $article_content['article_type'];
                            $year = $article_content['year'];
                            $month = $article_content['month'];
                            $month_r = sprintf("%02d",$month);
                            $day = $article_content['day'];
                            $day_r = sprintf("%02d",$day);
                            if($type == 3){
                                $id = $article_content['id'];
                                $article_title = $article_content['title'];
                            ?>
                    <li style="list-style-type:none;color:#a0a0a0;padding-top: 8px;padding-bottom: 8px;"><?php echo $year,'/',$month_r,'/',$day_r, '&nbsp;&nbsp;<a href="activity2.php?article_id=',$id,'" style="text-decoration:none;color:#356618;font-weight:bold;">',$article_title, '</a>'; ?></li>
                            <?php
                            }

                        }
                        }
                        ?>
                    </ul>
                    <?php
                    }
                    ?>


				<p>
                </p>

                <h3></h3>

                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
			</div>
		</div>
		<div id="footer">

			<p>
Advanced Gerontological Expertise Institute (AGEI)&copy; 2016  | All Rights Reserved<br>
62102 嘉義縣民雄大學路一段168號 &nbsp;&nbsp;創新大樓(管理學院)487室&nbsp;&nbsp;聯絡信箱:deptagei@ccu.edu.tw &nbsp;&nbsp;電話：05-2720411#24027(總機)或撥專線05-2729065</br></p>
		</div>
	</div>
</body>
</html>