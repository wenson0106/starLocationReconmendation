<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>天動萬象</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="./星象.js"></script>
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/index.css" rel="stylesheet" />
  </head>
  <style>
    #data_title{
      font-size:60px;
    }
  </style>
  <body>
    <main>
      <div id="now_time" style="position:absolute;width:100%;top:0;left:0;background-color:#001739;height:30px;line-height:30px;text-align:center;"></div>
      <h1 id="data_title">超級月亮</h1>
      <div id="card">
        <div id="date">
          <h3>日期</h3>
          <h2 id="data_date">08/28</h2>
        </div>
        <div id="time">
          <h3>時間</h3>
          <h2 id="data_time">09:36</h2>
        </div>
      </div>
      <div></div>
      <article>
        <!-- <div id="rateANDrecommend">
          <img src="./icons/star.svg" /><img src="./icons/star.svg" /><img
            src="./icons/star.svg"
          /><img src="./icons/star.svg" />
          <p id="data_loc">墾丁龍磐公園</p>
        </div> -->
        <p  id="data_info">
          月球於 09:36 望，視直徑 32.95'，距地球 357,340 公里，為今年最大滿月。
        </p>
      </article>
    </main>
    <nav id="function-Menu">
      <button onclick="location.href='./index.php';" style = "background-image: url('./icons/home_focus.svg')" id="focus"></button>
      <button onclick="location.href='./information.php';" style = "background-image: url('./icons/event.svg')"></button>
      <button onclick="location.href='./community.php';" style = "background-image: url('./icons/groups.svg')"></button>
      <button onclick="location.href='./knowledge.php';" style = "background-image: url('./icons/importContacts.svg')"></button>
    </nav>
    <script>
      window.onload = function() {
        const body = document.querySelector('body');
        const nav = document.querySelector('#function-Menu');
        const main = document.querySelector('main');

        const bodyHeight = body.offsetHeight;
        const navHeight = nav.offsetHeight;
        main.style.height = `calc(${bodyHeight}px - ${navHeight}px)`;
      }
    </script>
    <script>
      const now = new Date();

      function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}/${month}/${day} ${hours}:${minutes}`;
      }

      function updateNowTime() {
        const now_time = new Date();
        const formattedNow = formatDate(now_time);
        document.getElementById("now_time").innerHTML = formattedNow;
      }

      updateNowTime();
      setInterval(updateNowTime, 1000);

      data.forEach((item) => {
        item.dateObj = new Date(item.date + "T" + item.eventName.split(", ")[0]);
      });

      
      const filteredAndSortedData = data
        .filter((item) => item.dateObj > now)
        .sort((a, b) => a.dateObj - b.dateObj);

      
      const nearestEvent = filteredAndSortedData[0];

      var title=nearestEvent.eventName.split(", ")[1].split("，")[0];
      document.getElementById("data_title").innerHTML=title;

      var d=nearestEvent.date.split("-");
      var date=d[1]+"/"+d[2];
      document.getElementById("data_date").innerHTML=date;

      var time=nearestEvent.eventName.split(",")[0];
      document.getElementById("data_time").innerHTML=time;

      // document.getElementById("data_loc").innerHTML=date;

      document.getElementById("data_info").innerHTML=nearestEvent.eventName;
    </script>
  </body>
</html>