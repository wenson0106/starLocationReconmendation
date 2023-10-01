<?php
session_start();

$isLoggedIn = isset($_SESSION['account']);

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo '<script>alert("' . $message . '");</script>';
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>天文社群</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/community.css" rel="stylesheet" />
  </head>
  <body>
    <main>
      <!-- 通知 -->
      <div class="notification" id="notification">貼文發佈成功！</div>

      <!-- 右上角的發佈與登入按鈕 -->
      <nav>
        <h3><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '訪客'; ?></h3>
        <div></div>
        <button class="open-button" id="openModal"></button>
        <button id="login-btn">
          <?php echo isset($_SESSION['account']) ? '登出' : '登入'; ?>
        </button>
      </nav>

      <!-- 登入表單 -->
      <div class="modal" id="loginModal">
        <div class="modal-content">
          <span class="close-button" id="closeLoginModal">&times;</span>
          <h2>登入</h2>
          <form id="login-form" action="./login.php" method="POST">
            <label for="account">帳號：</label>
            <input type="email" id="account" name="account" required>
            <label for="password">密碼：</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" id="login-submit">登入</button>
          </form>
        </div>
      </div>

      <!-- 發佈貼文表單 -->
      <div class="modal" id="postModal">
        <div class="modal-content">
          <span class="close-button" id="closeModal">&times;</span>
          <h2>新增貼文</h2>
          <form id="post-form">
            <label for="post-image">選擇圖片：</label>
            <input type="file" id="post-image" accept="image/*" required>

            <!-- 圖片預覽區域 -->
            <div class="image-preview" id="image-preview"></div>

            <br><br>
            <label for="post-content">內容：</label>
            <textarea id="post-content" required></textarea>
            <br><br>

            <button type="submit" id="submit">發佈</button>
          </form>
        </div>
      </div>

      <!-- 預設貼文 -->
      <div class="post-container">
        <div class="image-container">
          <img src="./img2.jpg" alt="Post Image">
        </div>
        <div class="action-buttons">
          <button class="like-button">👍 <span class="like-counter">0</span></button>
          <button class="heart-button">❤️ <span class="heart-counter">0</span></button>
          <?php if ($isLoggedIn): ?>
            <button class="delete-button">🗑️</button>
          <?php endif; ?>
        </div>
        <div class="content-container">
          <p>這是「獵戶座流星雨」，大家有許願嗎!</p>
        </div>
      </div>
      <div class="post-container">
        <div class="image-container">
          <img src="./img1.jpg" alt="Post Image">
        </div>
        <div class="action-buttons">
          <button class="like-button">👍 <span class="like-counter">0</span></button>
          <button class="heart-button">❤️ <span class="heart-counter">0</span></button>
          <?php if ($isLoggedIn): ?>
            <button class="delete-button">🗑️</button>
          <?php endif; ?>
        </div>
        <div class="content-container">
          <p>超級月亮超震撼的啦!&nbsp;&nbsp;🌕</p>
        </div>
      </div>
    </main>
    <nav id="function-Menu">
      <button onclick="location.href='./index.php';" style = "background-image: url('./icons/home.svg')"></button>
      <button onclick="location.href='./information.php';" style = "background-image: url('./icons/event.svg')"></button>
      <button onclick="location.href='./community.php';" style = "background-image: url('./icons/groups_focus.svg')" id="focus"></button>
      <button onclick="location.href='./knowledge.php';" style = "background-image: url('./icons/importContacts.svg')"></button>
    </nav>
    <script>
      // 為單一貼文綁定讚、愛心和刪除事件
      function bindPostActions(postElement) {
          postElement.querySelector('.like-button').addEventListener('click', function() {
              if (!<?php echo $isLoggedIn ? 'true' : 'false'; ?>) {
                  alert('請先登入！');
                  return;
              }
              let counter = this.querySelector('.like-counter');
              counter.textContent = parseInt(counter.textContent) + 1;
          });

          postElement.querySelector('.heart-button').addEventListener('click', function() {
              if (!<?php echo $isLoggedIn ? 'true' : 'false'; ?>) {
                  alert('請先登入！');
                  return;
              }
              let counter = this.querySelector('.heart-counter');
              counter.textContent = parseInt(counter.textContent) + 1;
          });

          postElement.querySelector('.delete-button').addEventListener('click', function() {
              if (!<?php echo $isLoggedIn ? 'true' : 'false'; ?>) {
                  alert('請先登入！');
                  return;
              }
              const isConfirmed = window.confirm('您確定要刪除這篇貼文嗎？');
              if (isConfirmed) {
                  postElement.remove();
              }
          });
      }

      window.onload = function() {
        const body = document.querySelector('body');
        const nav = document.querySelector('#function-Menu');
        const main = document.querySelector('main');
        const openbtn = document.querySelector('.open-button');

        const bodyHeight = body.offsetHeight;
        const navHeight = nav.offsetHeight;
        const openbtnHeight = openbtn.offsetHeight;
        main.style.height = `calc(${bodyHeight}px - ${navHeight}px)`;
        openbtn.style.width = `${openbtnHeight}px`;

        // 為所有貼文綁定讚、愛心和刪除事件
        const allPosts = document.querySelectorAll('.post-container');
        allPosts.forEach(bindPostActions);
      }

      // 開啟與關閉彈出式視窗的事件
      const modal = document.getElementById('postModal');
      const openBtn = document.getElementById('openModal');
      const closeBtn = document.getElementById('closeModal');

      openBtn.addEventListener('click', function() {
        if (!<?php echo $isLoggedIn ? 'true' : 'false'; ?>) {
            alert('請先登入！');
            return;
        }
        modal.style.display = "block";
      });

      closeBtn.addEventListener('click', function() {
        modal.style.display = "none";
      });

      window.addEventListener('click', function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      });

      document.getElementById('post-form').addEventListener('submit', function(event) {
        event.preventDefault();

        if (!<?php echo $isLoggedIn ? 'true' : 'false'; ?>) {
          alert('請先登入！');
          return;
        }

        const imageFile = document.getElementById('post-image').files[0];
        const content = document.getElementById('post-content').value;

        if (!imageFile || !content) {
          alert('請確保已選擇圖片和輸入內容！');
          return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
          const newPost = document.createElement('div');
          newPost.classList.add('post-container');

          newPost.innerHTML = `
            <div class="image-container">
              <img src="${e.target.result}" alt="User Post Image">
            </div>
            <div class="content-container">
              <p>${content}</p>
            </div>
            <div class="action-buttons">
              <button class="like-button">👍 <span class="like-counter">0</span></button>
              <button class="heart-button">❤️ <span class="heart-counter">0</span></button>
              <button class="delete-button">🗑️</button>
            </div>
          `;

          const mainElement = document.querySelector('main');
          const navElement = mainElement.querySelector('nav');
          
          if (navElement && navElement.nextSibling) {
              mainElement.insertBefore(newPost, navElement.nextSibling);
          } else {
              mainElement.appendChild(newPost);
          }

          document.getElementById('post-form').reset();

          // 清空圖片預覽
          document.getElementById('image-preview').innerHTML = '';

          // 為新的貼文綁定讚、愛心和刪除事件
          bindPostActions(newPost);

          const notification = document.getElementById('notification');
          notification.style.display = 'block';

          setTimeout(() => {
            notification.classList.add('hidden'); // 先使其透明

            // 在動畫結束後再隱藏元素
            setTimeout(() => {
              notification.style.display = 'none';
              notification.classList.remove('hidden'); // 還原透明度，以供下次使用
            }, 500); // 這裡的500毫秒應該和你CSS中設定的動畫時間相同
          }, 1500);

          modal.style.display = "none";
        }

        reader.readAsDataURL(imageFile);
      });

      document.getElementById('post-image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            document.getElementById('image-preview').innerHTML = `<img src="${e.target.result}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">`;
          }
          reader.readAsDataURL(file);
        } else {
          document.getElementById('image-preview').innerHTML = ''; // 清除預覽
        }
      });

      const loginModal = document.getElementById('loginModal');
      const loginBtn = document.getElementById('login-btn');
      const closeLoginBtn = document.getElementById('closeLoginModal');

      loginBtn.addEventListener('click', function() {
        const btnText = loginBtn.textContent.trim();
        if (btnText === '登入') {
          loginModal.style.display = "block";
        } else {
          // 阻止事件繼續傳播
          event.stopPropagation();
          
          // 登出操作，重新導向到登出處理頁面
          window.location.href = './logout.php';
        }
      });

      closeLoginBtn.addEventListener('click', function() {
          loginModal.style.display = "none";
      });
    </script>
  </body>
</html>