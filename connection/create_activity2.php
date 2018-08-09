<?php
include('write.php');
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>創建文章</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

</head>
<body>
    <div id="page">
        <div id="header">
            <span><a href="../../connection/logout.php" id="login"> | Log out |</a></span>
            <div align="center">
            <a href="login_news.php" id="logo"><img src="../../images/logo-3.png" alt="Logo" height="75" ></a></div>
            <ul>
                <li>
                    <a href="../login_news.php">內部消息公告</a>

                </li>
                <li>
                    <a href>發表文章</a>
                    <ul>
                        <li>
                            <a href="create_new1.php">活動公告</a>
                        </li>
                        <li>
                            <a href="create_new2.php">講座訊息</a>
                        </li>
                        <li>
                            <a href="create_activity2.php">歷年活動</a>
                        </li>
                        <li>
                            <a href="inside_new.php">發表內部消息</a>             </li>
                    </ul>
                </li>

                 <li>
                    <a href>文件上傳</a>
                    <ul>
                     <li>
                            <a href="../upload/upload_file.php">活動檔案</a>            </li>
                     <li>
                            <a href="../upload/upload_form.php">表單文件</a>            </li>
                    <li>
                            <a href="../upload/create_album.php">相簿區</a>            </li>
                    </ul>
                </li>
                <li>
                    <a href="../login_myarticle.php">管理我的文章</a>

                </li>
                <li>
                    <a href="../updatepd.php">更改密碼</a>
                </li>
            </ul>
        </div>
        <div id="body">
            <div id="content">

                <h2>創建歷年活動</h2>
                <!-- Upload Information -->
                <form action="" method="post">
                    <label for="title"><span>標題&nbsp;</span></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                    <br />
                    <br />
                    <label for="year"><span>日期 :&nbsp;</span></label>
                    <input type="text" name="year" id="year" class="form-control" placeholder="year" style="width: 50px;">
                    <label for="month"><span>年</span></label>
                    <input type="text" name="month" id="month" class="form-control" placeholder="month" style="width: 50px;">
                    <label for="day"><span>月</span></label>
                    <input type="text" name="day" id="day" class="form-control" placeholder="day" style="width: 50px;">日
                    <br />
                    <br />
                    <label for="article"><span>內容</span><br/></label>
                    <br />
                    <div class="btn-group" id="mode">
                        <button type="button" class="button active" onclick="coprecre()">編寫區塊</button>
                        <button type="button" class="button" onclick="htprecre()">預覽畫面</button>
                    </div>
                    <br />
                    <div class="btn-group">
                        <button type="button" class="button" onclick="createaddeffect('Strong')">粗體</button>
                        <button type="button" class="button" onclick="createaddeffect('em')">斜體</button>
                        <button type="button" class="button" onclick="createaddeffect('R')">紅色</button>
                        <button type="button" class="button" onclick="createaddeffect('B')">藍色</button>
                        <button type="button" class="button" onclick="createaddeffect('G')">綠色</button>
                        <button type="button" class="button" onclick="createaddeffect('Link')">連結</button>
                        <p>註: 選取的字體將變成粗體/斜體/連結等等</p>
                    </div>
                    <textarea name="article" id="article" class="form-control" style="width: 400px; height:200px;"></textarea>

                    <div id="prevpost"></div>

                    <br />
                    <input type="hidden" name="article_type" class="form-control" value="3">
                    <button type="submit" class="button" name="save" method="post">Save</button>
                    <button type="submit" class="button" name="back" method="post">Back</button>
                    <span style="color:red;"><?php echo $error; ?></span>
                </form>

                </p>
                <p>
                </p>
                <p>

                </p>
                <p>

                </p>
            </div>
        </div>


        <div id="footer">
            <p>
Advanced Gerontological Expertise Institute &copy; 2016  | All Rights Reserved
            </p>
        </div>
    </div>
</body>
<script>
    $('#mode').on('click', '.clickable-btn', function(event) {
        $(this).addClass('active').siblings().removeClass('active');
    });
    function htprecre() {
        document.getElementById("article").style.display = "none";
        var pre = document.getElementById("article").value;
        pre = pre.replace(/\n/g, "<br />");
        pre = pre.split("<R>").join("<span style='color:red;'>");
        pre = pre.split("</R>").join("</span>");
        pre = pre.split("<B>").join("<span style='color:blue;'>");
        pre = pre.split("</B>").join("</span>");
        pre = pre.split("<G>").join("<span style='color:green;'>");
        pre = pre.split("</G>").join("</span>");
        pre = pre.split("<Strong>").join("<span style='font-weight:bold;'>");
        pre = pre.split("</Strong>").join("</span>");
        pre = pre.split('<Link="').join('<a target="_blank" href="');
        pre = pre.split("</Link>").join("</a>");
        document.getElementById("prevpost").innerHTML = pre + '<br />';
        document.getElementById("prevpost").style.display = "initial";
    }

    function coprecre() {
        document.getElementById("article").style.display = "initial";
        document.getElementById("prevpost").style.display = "none";
    }
    function createaddeffect(color) {
        var area = document.getElementById("article");
        if ((area.selectionStart || area.selectionStart == 0) && area.selectionStart != area.selectionEnd) {
            var start = area.selectionStart,
                end = area.selectionEnd;
            if(color == 'Link'){
                area.value = area.value.substring(0, start) + '<' + color +'="' + area.value.substring(start, end) + '">' + area.value.substring(start, end) + '</' + color + '>' + area.value.substring(end, area.value.length);
            }
            else{
                area.value = area.value.substring(0, start) + '<' + color + '>' + area.value.substring(start, end) + '</' + color + '>' + area.value.substring(end, area.value.length);
            }
            area.selectionStart = start;
            area.selectionEnd = start + color.length * 2 + 5 + area.value.substring(start, end).length;
        }
    }
</script>
</html>