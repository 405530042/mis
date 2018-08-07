<?php
if ($handle = opendir('./update/')) {  //開啟現在的資料夾
      while (false !== ($file = readdir($handle))) {
//避免搜尋到的資料夾名稱是false,像是0
          if ($file != "." && $file != "..") {
//去除掉..跟.
              echo "<a href='$file'>$file</a><br>";             
          }
      }
      closedir($handle);
  }



  foreach(glob('*',GLOB_ONLYDIR) as $directory)
{
echo 'Directory name: ' . $directory . '<br />';
}
?>