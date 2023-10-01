<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>天文百科</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/knowledge.css" rel="stylesheet" />
  </head>
  <style>
    #arrow{
      width: 6%;
    }

  </style>
  <body>
    <main>
      <section class="search-section">
        <h2>搜尋天文知識</h2>
        <div class="search-bar">
        <input type="text" id="astronomy-search" placeholder="輸入關鍵字..." value="<?php if(isset($_GET["search"])){echo $_GET["search"];}?>">
          <!-- <button onclick="searchKnowledge()">🔍</button> -->
        </div>
      </section>

      <section class="knowledge-section">
        <h2>熱門天文知識</h2>
        <article>
          <h3>黑洞是什麼？</h3>
          <p>黑洞是一個密度非常高的天體，其引力如此之強，以至於甚至光也無法逃脫。</p>
        </article>
        
        <article>
          <h3>太陽系的組成</h3>
          <p>太陽系由太陽和圍繞其運行的行星、衛星、小行星、彗星等組成。</p>
        </article>
        
        <article>
          <h3>什麼是流星雨？</h3>
          <p>當地球通過彗星留下的碎片雲時，這些碎片進入大氣層燃燒，形成流星雨。</p>
        </article>

        <article class="hidden">
            <h3 class="check">合月 <img src="arrow.png" id="arrow"/></h3>
            <p>指的是某個行星與月球在天空中的相對位置非常接近。</p>
            <div class="content" style="display: none;">
              <article>
                <h3>水星合月</h3>
                <p>指的是水星與月球在天空中的相對位置非常接近。</p>
              </article>
              <article>
                <h3>金星合月</h3>
                <p>指的是金星與月球在天空中的相對位置非常接近。</p>
              </article>
              <article>
                <h3>火星合月</h3>
                <p>指的是火星與月球在天空中的相對位置非常接近。</p>
              </article>
              <article>
                <h3>木星合月</h3>
                <p>指的是木星與月球在天空中的相對位置非常接近。</p>
              </article>
              <article>
                <h3>土星合月</h3>
                <p>指的是土星與月球在天空中的相對位置非常接近。</p> 
              </article>
              <article>
                <h3>天王星合月</h3>
                <p>指的是天王星與月球在天空中的相對位置非常接近。</p>
              </article>
              <article>
                <h3>海王星合月</h3>
                <p>指的是海王星與月球在天空中的相對位置非常接近。</p>
              </article>
            </div>

        </article>

        <article class="hidden">
            <h3 class="check">留 <img src="arrow.png" id="arrow"/></h3>
            <p>當一個行星在天空中的東西運動暫停並開始反向運動時，我們稱之為行星「留」。</p>
            <div class="content" style="display: none;">
              <article>
                <h3>水星留</h3>
                <p>當水星在天空中的東西運動暫停並開始反向運動時，我們稱之為「水星留」。</p>
              </article>
              <article>
                <h3>金星留</h3>
                <p>當金星在天空中的東西運動暫停並開始反向運動時，我們稱之為「金星留」。</p>
              </article>
              <article>
                <h3>火星留</h3>
                <p>當火星在天空中的東西運動暫停並開始反向運動時，我們稱之為「火星留」。</p>
              </article>
              <article>
                <h3>木星留</h3>
                <p>當木星在天空中的東西運動暫停並開始反向運動時，我們稱之為「木星留」。</p>
              </article>
              <article>
                <h3>土星留</h3>
                <p>當土星在天空中的東西運動暫停並開始反向運動時，我們稱之為「土星留」。</p>
              </article>
              <article>
                <h3>天王星留</h3>
                <p>當天王星在天空中的東西運動暫停並開始反向運動時，我們稱之為「天王星留」。</p>
              </article>
              <article>
                <h3>海王星留</h3>
                <p>當海王星在天空中的東西運動暫停並開始反向運動時，我們稱之為「海王星留」。</p>
              </article>
            </div>

        </article>

        <article>
            <h3>上弦和下弦</h3>
            <p>描述月亮的相位。上弦月是月亮從新月到滿月的過程中的半圓形，而下弦月則是滿月到新月的半圓形。</p>
        </article>

        <article>
            <h3>望</h3>
            <p>滿月的時候。</p>
        </article>

        <article>
            <h3>朔</h3>
            <p>新月的時候。</p>
        </article>

        <article>
            <h3>近日點和遠日點</h3>
            <p>分別指地球離太陽最近和最遠的點。</p>
        </article>

        <article>
            <h3>近地點和遠地點</h3>
            <p>指的是月球在其軌道上離地球最近和最遠的點。</p>
        </article>

        <article class="hidden">
            <h3 class="check">合日 <img src="arrow.png" id="arrow"/></h3>
            <p>當一個行星與太陽在天空中的相對位置非常接近，這意味著行星位於太陽的背後。</p>
            <div class="content" style="display: none;">
              <article>
                <h3>水星下合日</h3>
                <p>當水星與太陽在天空中的相對位置非常接近，這意味著水星位於太陽的背後。</p>
              </article>
              <article>
                <h3>金星下合日</h3>
                <p>當金星與太陽在天空中的相對位置非常接近，這意味著金星位於太陽的背後。</p>
              </article>
              <article>
                <h3>火星下合日</h3>
                <p>當火星與太陽在天空中的相對位置非常接近，這意味著火星位於太陽的背後。</p>
              </article>
              <article>
                <h3>木星下合日</h3>
                <p>當木星與太陽在天空中的相對位置非常接近，這意味著木星位於太陽的背後。</p>
              </article>
              <article>
                <h3>土星下合日</h3>
                <p>當土星與太陽在天空中的相對位置非常接近，這意味著土星位於太陽的背後。</p> 
              </article>
              <article>
                <h3>天王星下合日</h3>
                <p>當天王星與太陽在天空中的相對位置非常接近，這意味著天王星位於太陽的背後。</p>
              </article>
              <article>
                <h3>海王星下合日</h3>
                <p>當海王星與太陽在天空中的相對位置非常接近，這意味著海王星位於太陽的背後。</p>
              </article>
            </div>
        </article>

        <article>
            <h3>西大距和東大距</h3>
            <p>這是內行星（水星和金星）從太陽的角度看到的最大距離。西大距發生在日落後不久，東大距發生在日出之前。</p>
        </article>

        <article class="hidden">
            <h3 class="check">衝 <img src="arrow.png" id="arrow"/></h3>
            <p>當一個外行星（火星、木星、土星、天王星、海王星）與太陽正好在地球的相反方向時，我們說該行星「衝」。</p>
            <div class="content" style="display: none;">
              <article>
                <h3>水星衝日</h3>
                <p>當水星與太陽正好在地球的相反方向時，我們說水星「衝」。</p>
              </article>
              <article>
                <h3>金星衝日</h3>
                <p>當金星與太陽正好在地球的相反方向時，我們說金星「衝」。</p>
              </article>
              <article>
                <h3>火星衝日</h3>
                <p>當火星與太陽正好在地球的相反方向時，我們說火星「衝」。</p>
              </article>
              <article>
                <h3>木星衝日</h3>
                <p>當木星與太陽正好在地球的相反方向時，我們說木星「衝」。</p>
              </article>
              <article>
                <h3>土星衝日</h3>
                <p>當土星與太陽正好在地球的相反方向時，我們說土星「衝」。</p> 
              </article>
              <article>
                <h3>天王星衝日</h3>
                <p>當天王星與太陽正好在地球的相反方向時，我們說天王星「衝」。</p>
              </article>
              <article>
                <h3>海王星衝日</h3>
                <p>當海王星與太陽正好在地球的相反方向時，我們說海王星「衝」。</p>
              </article>
            </div>
        </article>

        <article>
            <h3>東方照和西方照</h3>
            <p>當一個行星開始其逆行或順行運動時，分別稱為東方照和西方照。</p>
        </article>
      </section>
    </main>
    <nav id="function-Menu">
      <button onclick="location.href='./index.php';" style = "background-image: url('./icons/home.svg')"></button>
      <button onclick="location.href='./information.php';" style = "background-image: url('./icons/event.svg')"></button>
      <button onclick="location.href='./community.php';" style = "background-image: url('./icons/groups.svg')"></button>
      <button onclick="location.href='./knowledge.php';" style = "background-image: url('./icons/importContacts_focus.svg')" id="focus"></button>
    </nav>
    <script>
      window.onload = function() {
        const body = document.querySelector('body');
        const nav = document.querySelector('#function-Menu');
        const main = document.querySelector('main');

        const bodyHeight = body.offsetHeight;
        const navHeight = nav.offsetHeight;
        main.style.height = `calc(${bodyHeight}px - ${navHeight}px)`;
        searchKnowledge();
        document.getElementById('astronomy-search').addEventListener('input', function() {
          searchKnowledge();
        });
      }

      // document.addEventListener('DOMContentLoaded', function() {
      //   // 綁定搜尋按鈕的事件
      //   document.querySelector('button').addEventListener('click', searchKnowledge);
        
      //   // 綁定輸入框的 keyup 事件，檢查是否按下了 Enter 鍵
      //   document.getElementById('astronomy-search').addEventListener('keyup', function(event) {
      //     if (event.key === "Enter") {
      //       searchKnowledge();
      //     }
      //   });
      // });

      function searchKnowledge() {
        const keyword = document.getElementById('astronomy-search').value.toLowerCase();
        const articles = document.querySelectorAll('.knowledge-section article');

        let found = false;

        articles.forEach(article => {
          const title = article.querySelector('h3').innerText.toLowerCase();

          if (title.includes(keyword)) {
            article.style.display = 'block';
            found = true;
          } else {
            article.style.display = 'none';
          }
        });

        const contents = document.querySelectorAll('.content article');
        
        contents.forEach(content => {
          const content_title = content.querySelector('h3').innerText.toLowerCase();

          if (content_title.includes(keyword)) {
            content.parentNode.style.display = 'block';
            content.parentNode.parentNode.style.display = 'block';
            content.style.display = 'block';
            found = true;
          } else {
            content.style.display = 'none';
          }
        });

        if (!found) {
          // alert('未找到相關天文知識！');
        }
      }
      document.querySelectorAll(".hidden").forEach(article => {
        const content = article.querySelector(".content");

        article.addEventListener("click", function() {
            if (content.style.display === "none" || content.style.display === "") {
                
                content.style.display = "block";
            } else {
                
                content.style.display = "none";
            }
        });
    });
    </script>
  </body>
</html>