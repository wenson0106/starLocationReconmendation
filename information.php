<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>天文月曆</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYyDmnO8GjuuuHjkSkkgAbowwSe_K6l5o&libraries=places"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/information.css" rel="stylesheet" />
  </head>
  <style>
    
    #modal{
      overflow: hidden;
      background-image: url(./bg.jpg);
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      display: none;
      z-index: 90;
      background-size: cover;
      background-position: center;
    }
    #modal_mask{
      /* background-image: url("./bg.jpg"); */
      width:100%;
      height:100%;
      position:absolute;
      top:0;
      left:0;
      /* display:none; */
      z-index:100;
      background-size: cover;
      background-position: center;
      overflow: hidden;
    }

  </style>
  <style>
    #city {
      color: white;
      font-size: 60px;
      font-weight: bold;
      top: 20px;
      left: 30px;
      position: absolute;
    }
    body {
      background-color: #222;
    }
    svg {
      width: 80%;
      margin: 20vh 10% 0 5%;
      position: absolute;
    }
    path {
      stroke: white;
      fill: transparent;
      transition: 0.5s;
    }
    /* path:hover {
      cursor: pointer;
      transform: translate(-5px, -5px);
      fill: #ad9421;
    } */
    #exit_modal{
      position:absolute;
      top:10px;
      left:10px;
      color:white;
      font-size:30px;
      z-index:1000;
    }
    .loc_icon{
      font-size: 12px;
      color: rgb(234, 67, 53);
      position: absolute;
      z-index: 101;
      text-shadow: 1px 1px 0px #313131;
    }
    .loc_label{
      font-size: 12px;
      color: rgb(250 250 255);
      position: absolute;
      transform: scale(0.5);
      z-index: 101;
    }
    #modal_area{
      position: absolute;
      top:0;
      left:0;
      width: 100%;
      height:100%;
      transition: transform 0.3s ease-in-out;
      transform-origin: center center;
    }
    #show_weather {
      position: absolute;
      left: 50%; 
      transform: translateX(-50%); 
      bottom: 0;
      height:30% ;
      width: 95%;
      display: none;
      background-color: rgb(154, 179, 229);
      border-top-left-radius: 20px; 
      border-top-right-radius: 20px; 
      z-index: 200;
    }
    #loc{
      position: absolute;
      line-height: 2;
      font-size: 27px;
      left:7% ;
      font-weight: bold;
      color: white;
    }
    #score{
      position: absolute;
      line-height: 2;
      left: 45%;
      top: 25%;
      font-size: 18px;
      font-weight: bold;
      color: rgb(255, 219, 77);
    }
    #day{
      margin-top: 14%;
    }
    #day,#weatherTarget, #sunRiseTime, #maxmin,#rain {
      font-size: 18px;
      color: white;
      line-height: 2;
      margin-left: 7% ;
    }
    #weather_icon{
      width: 17%;
      position: absolute;
      line-height: 2;
      right: 5%;
      top: 25%;
    }
    #star{
      width: 7%;
      position: absolute;
      line-height: 2;
      left: 37%;
      top: 27%;
    }
    .best{
      color:#ffb100;
    }
    .recommend_btn{
      border: 2px solid #656565;
      border-radius: 5px;
      width: 100px;
      height: 22px;
      margin: 0 calc(100% - 100px);
      line-height: 18px;
      text-align: center;
      color: black;
      background-color: #afafaf;
      padding: 0;
      font-weight: 600;
    }
    #messagebox {
      width: 300px;
      border-radius: 5px;
      position: absolute;
      display: none;
      z-index: 150;
      height: 35px;
      line-height: 35px;
      color: #d90000;
      background-color: #fff7f7;
      font-weight: bold;
      text-shadow: 1px 1px 0px #c9c9c9;
      font-size: 24px;
      text-align: center;
      top: calc(40vh - 17.5px);
      left: calc(50% - 150px);
    }
    a {
      /* text-decoration: none; */
      color: inherit;
      outline: none;
      box-shadow: none;
    }
  </style>
  <body>
  <div id="messagebox"></div>
    <main>
      <div id="calendar"></div>
      <div class="legend">
        <span class="entry orange">Moon</span
        ><span class="entry green">Other</span
        ><span class="entry blue">Planet</span>
      </div>
    </main>
    <nav id="function-Menu">
      <button
        onclick="location.href='./index.php';"
        style="background-image: url('./icons/home.svg')"
      ></button>
      <button
        onclick="location.href='./information.php';"
        style="background-image: url('./icons/event_focus.svg')"
        id="focus"
      ></button>
      <button
        onclick="location.href='./community.php';"
        style="background-image: url('./icons/groups.svg')"
      ></button>
      <button
        onclick="location.href='./knowledge.php';"
        style="background-image: url('./icons/importContacts.svg')"
      ></button>
    </nav>
    <div id="modal">
      <i id="exit_modal" class="fa-solid fa-xmark"></i>
      
        <div id="modal_mask">
        
        <div id="modal_area">
          <svg
            id="svg_img" 
            baseprofile="tiny"
            fill="#7c7c7c"
            stroke="#ffffff"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            version="1.2"
            viewbox="0 0 1000 1295"
            width="1000"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M739.8 857.3l1.9 5.8-3 5-5.6 2.4-1.4 3.2 1 4 5.6 3.6 6.3 5.2 2.8 7.6 0.3 2.5-15.6 3.8-6.4 4.1-4 3.9-7.8 5.1-0.9 5.7 2.3 6-2.7 4.9-7.4 4-0.8 6.9 2.1 9.9-3 13.2-0.1 11.2-4.3 5.9-8.5 7.2-2.3 9.8 1.3 8.1 3 4.6 6.2 6.4 1.2 4.9-3.9 0.5-5.2-0.9-4.3 0.2-8.5 6.7-5.9-5.5-7.6-8.9-7.2 1.8-6.6 5.9-13.1-6.6-9.4 4.5-6.4 7.1-8 2.8-17.8-1.1-1.7 4.9-1.3 7.2-2.6 7.9 0.5 7-0.1 9.5-5.7 21.2-0.1 7.1 2.7 7.5 0.4 8.2-8.1 20.5-2.6-1.1-1.6 0.1-1.8 0.7-2.2 0-13-10.2-12.1-17.1 12.7 15.4-1.5-7.4-3.8-7.2-5.3-6-9-8.4-3.5-4.2-1.6-4.8 2.2-4.6 1.1-4.1-1.5-5.8-2.7-5.6-4.9-7.7-4.6-10.2-1-4.5 0.1-3 1.5-3.6 0.3-2.4-0.5-1.2-2.7-2.3-0.5-2.3-2.9-4.9-0.7-2-2.1-13.6 6.1-3.7 0.2 0.5 3.9 8.6 4.8 2.5 15.7 2.2 8.2-0.9 8.4 1 4.2-1.5 3.5-2.6 6.5-2.6 6.3-4.4 2.4-5.5 3-5.2 5.3-7.1 6.1-6.4 6.5-5.4 7.4-7.2 6.5-8.4 10-17 10.4-15.1 2.3-6.6-1-6.7-1.4-4.5 0.1-5 3.6-3.5 6.9 0.7 5.8-0.6 12.3-7.3 4.5-5.4 7.9-6.1 7.7-4.3 4.2-5 3.6-6.8 8.5-6.8 18.5-9.4 4.3 1 5.8 2.2 4.2 5.9 0.7 2z"
              id="TWN1156"
              name="Kaohsiung City"
            ></path>
            <path
              d="M569.4 1166l2 2.9-0.3 1-2.7 1.8-5 4.3-0.9-3.3 1.4-2.7 2.8-3.6 2 0 0.7-0.4z m126.7-143.3l3.5 6.6 0.7 4.9 5.4 1.3 5.5 3.6-2.8 13.8-0.1 5.2-2 5-9.8 4.1-4.8 2.7-7.6 1.6-5.4 4.5-2.4 6.6-3.7 6.6-3 7.5-0.8 14.7 1.2 6.5 2 6.1 1.1 7.1 0 5.4 2.6 5 4.6 5.6-2.5 3.8-5.3 3.2-2.1 3.9-0.5 4.5 2.7 3.9 3.4 1.7 3.1 4.4-0.1 5.7 0.6 6.1 3.2 5.9 4.6 4.9 10.2 4.7 4.5-0.3 0.9 51.6-1.6 7.3-2.5 6-3.4 2.5-4 3.7 0.1 8.3 1.5 9.2-0.4 5.9-4.5-6.8-6.8-5.2-7.8-3.5-8-1.9-0.3 6.6-2.3 2.3-3.4-0.8-3.7-3.1-0.2-2.4 1.3-7-5.5-9.2-0.5-2.4 0.1-2.1 0.4-3.2 0-10.8 0.5-3.1 2.5-3.6 0.5-3-19.9-51.6-1.6-2.9-5.5-6.8-4.4-9.9-2-2.8-8.2-6.5-5.4-3-0.9-3.7-0.7-1.3-4.4-2.9-10-4.8-4.5-3.1-4.8-4.2-2.6-1.6 8.1-20.5-0.4-8.2-2.7-7.5 0.1-7.1 5.7-21.2 0.1-9.5-0.5-7 2.6-7.9 1.3-7.2 1.7-4.9 17.8 1.1 8-2.8 6.4-7.1 9.4-4.5 13.1 6.6 6.6-5.9 7.2-1.8 7.6 8.9 5.9 5.5 8.5-6.7 4.3-0.2 5.2 0.9z"
              id="TWN1158"
              name="Pingtung"
            ></path>
            <path
              d="M483.8 968.3l-0.6 1.2-2.3-2-1.7-4.2 0.3-1.3 0.7 0 0.9 1.2 0.7 1.9 2.1 2.2-0.1 1z m0.5-27.6l-2.9 6.8 3.9-13.3 0.6 0.1-1.6 6.4z m3.5-12.8l3.5-9.9 0.5-0.1 0.2 1.9-4.2 8.1z m6.3-22.5l-0.4 2.4 0.6-10.6 0.5 0.2-0.7 8z m149.5 11.5l-2.3 6.6-10.4 15.1-10 17-6.5 8.4-7.4 7.2-6.5 5.4-6.1 6.4-5.3 7.1-3 5.2-2.4 5.5-6.3 4.4-6.5 2.6-3.5 2.6-4.2 1.5-8.4-1-8.2 0.9-15.7-2.2-4.8-2.5-3.9-8.6-0.2-0.5-6.1 3.7-1-6.3-1.8-3.6-3.9-3.9 4.7-3.4 2.7-6.1-1.1-5.2-6.3-0.9-1.2 1.8-1.1 3.4-1.8 2.7-3.3-0.1-1.3-2.3 0.5-7-0.8-2.4-4.1-1.8-2.3 2.1-1.8 2.9-2.8 0.7-2.9-2.5-0.7-3.5 0.7-3.4 1.1-2.3 3-1.6 3.7-0.5 3.1-1 1-3-1.4-1.5-9.4-2.4 0-1.9 7.9-0.1-0.8-2.6-4.3-3.7-2.8-3.2 0.7-4 2.5-1.5 2.7-0.9 1.4-2.5-0.8-3.9-1.4-3.2 0.9-3 1.4-3.7 2.3-2.6-0.5-2.3 0.5-2.3 3.3-9 1.6-1.7 2.6-0.6-3.7-2.5 1.6-4.1 5.2 2 8.9 1.3 7.2 1.8 6.2-2.8 2.5-4.9 5.8-3.6 6.6-5.1 4.7-4.8 6.1-4.6 7.8-3.5 15.2-2.8 8.5-0.5 7.2 2.4 4 2.4 2.1 4.2 1.7 5.1 9.9 10.1 1 7.5-1.8 14.2 1.6 4.6 4.5 3.5 3.8 0 5.3-2.4 5-0.6 3.7 1.1 8.4 1z"
              id="TWN1160"
              name="Tainan City"
            ></path>
            <path
              d="M724.3 489l-0.2 0.2-4.6 1.1-4.4-1.7-2.7-3.8-4.3-2.6-6.9-2.7 1.2-4.1 5.5-11.4 2.2-3 0.7-1.5 0-1.7-0.7-1.9-1.1-2.2 1.5-3 1.8-1.8 8.3 3.6 15.1 4.8 5.4 2.8 3.8 3.9 1.9 3.7-1 3.6-2.4 1.4-5.1 0.9-5.9 2.4-3.4 4.3-2.3 5.6-2.4 3.1z"
              id="TWN1161"
              name="Hsinchu City"
            ></path>
            <path
              d="M843.1 523.6l-2.3 6.5-1.4 4.7 0.6 4.4-3.8 5.8-14 14.2-4.3 10.5-2.8-0.8-10.6 1-0.8 0.6-0.6-4.9-4.6-7.8-3.3-3.3-1.3-4.4-5-4-12.5 3.2-4.8-0.5-6.8 0.5-7.7 2.1-4.1-1 0.9-5.1 1.3-4.6-1-4-1-2.9 1-3.1 0.8-3.5 0.3-3.9-0.7-5.2-3.9-3.4-12.1-5.7-6-4.5-3.9-4.4-4.4-11.1 2.4-3.1 2.3-5.6 3.4-4.3 5.9-2.4 5.1-0.9 2.4-1.4 1-3.6-1.9-3.7-3.8-3.9-5.4-2.8-15.1-4.8-8.3-3.6 1.5-2.3 0.6-3.9 0.9-2.9 2-2.9 2.7-2.1 2.5-0.9-0.2-1.2 0.7-2.9 2.2-6.1 2.1-3.3 3.1 1.1 13.7-1 4.6 3.1 4 8.7 5 2 4.3 1.2 4.1 2 6.8 2.2 3.6 4.2-1.1 5.8 3.5 3.7 6.5 2.1 4.2 3.1 3.1 3.1 3.8 0.7 3.9-0.3 3.4 3.5 2.6 4.5 4.3 2.2 3.4 2.6 0.4 5 1.6 7.3-1.9 7.8-4.6 6.5 0.5 4.3 5.2 3.9 6.2 3.8 5.5 0.9 4 2.9 7.3 4.1 4.8 2.2z"
              id="TWN1162"
              name="Hsinchu"
            ></path>
            <path
              d="M982.4 448.9l2.1 0.5 1.6 2.2-0.7 2.3-3.8-0.1-1.4-0.8-1.7-2.7 0.9 0.3 3-1.7z m-47 152.6l-1.1 0-11.1-1.7-18.5-11.1-3.8 0.9-2.4 6-4.9 4.5-6.5 0-8.3-3.2-15-3.8-6.5-3.1-2.5-2.1-5.9-4.7-4.9 0-4.7 2.3-4 0.6-3.7-2.5-4.4-2.6-4.9-1-1.4-3.8 0.6-5.5-3.6-1 4.3-10.5 14-14.2 3.8-5.8-0.6-4.4 1.4-4.7 2.3-6.5 0.5-1.5 3.9-1.6 3.3 0.6 3.4-1.3 2.2-3.8-3.1-12.4 5.4-3.9 3.1-0.9 5.7-1.6 4.9-1.8 3.8-3.3 5-3.5 6.6-3.2 3.9-2.8-0.4-2-1-3.2-0.2-4.2 2-4.9 4.7-4 3.8-2.3 13-5.3 13.5-8.1 6.2-1.9 5-3.6 3.1-5 3.3-4.1 3.7-2 3.5-1.2 4.6-2.9 1.6-3.8-2.5-3.6 1.4-2.9 11.2-2.3 3.7-2.5 8.4-4.4 5.9-1.3 3.3 1.9 0.8 1.1-12 6-5.5 4.7-18.7 22.8-2.9 4.8-2.3 6.8-1.6 7.7-0.5 7.6 0.3 7.4 3.3 15.5-0.2 4-1.5 3.9 0.2 8.1 3.5 6.3 6.5 4 7.6 1.4 0 1.8-3.2-0.3-3.1 0.3-2.6 0.8-1.9 1.4 2.7 5 1.3 6.5-0.8 5.6-6 3.4-0.4 2.5 0.7 3 1.7 2.7 0.6 2.8-2.5 2.4-6.2 3.6-7 8-0.3 3.2 0.5 7-1.2 2.6-1.3 2.3-0.8 3.2-0.5 6.4-0.6 1.6-1 1.3-0.5 1.4 1.3 1.9z"
              id="TWN1163"
              name="Yilan"
            ></path>
            <path
              d="M934.8 365l-0.3 11.9 0.2 3 3.7 3.9-0.4 2.5-2.5 1.8-4 1.5-5.1-0.6-10.6-4.4-3-2.2-3.7-3.4-2.8-3.5-1.7-3.5-2.9-3.7-0.6-2.9 3.2-2.2 7.2-3.1 4.4-2.9 1.4 0.9 2.4 2.7 3.9 1.4 11.2 2.8z"
              id="TWN1164"
              name="Keelung City"
            ></path>
            <path
              d="M724.3 489l4.4 11.1 3.9 4.4 6 4.5 12.1 5.7 3.9 3.4 0.7 5.2-0.3 3.9-0.8 3.5-1 3.1 1 2.9 1 4-1.3 4.6-0.9 5.1 4.1 1 7.7-2.1 6.8-0.5 4.8 0.5 12.5-3.2 5 4 1.3 4.4 3.3 3.3 4.6 7.8 0.6 4.9-3.7 2.6-1.8 5.6-4.9 2-5.3-0.1-4.2 3-4.6 4.4-5.9 3.2-11.6 9.2-6.8 2.9-8.9 4.7-5.4-2.1-5-5.6-6-2.4-9.9-0.8-5.5 3.3-0.9 7.4-5.2 2.8-12.1 0.7-11.6-6.7-6.6-1.2-7.3-3.6-15.1-11.1-6.3-5.5-4.7-5-9.2-14.3 7.2-8.1 1.9-4 0.9-6.6 2.2-5.6 5.9-10.4 1.6-6.3 1.5-2.7 6.8-2 1.9-2.1 1.1-2.6 1.4-2.5 4.2-4.3 4.6-3.4 5.6-1.5 7.1 1.3-0.9-5.4 2.7-3.7 3.7-3.8 1.9-5.7 0.8-1.9 3.6-1.8 0.3-1.3 6.9 2.7 4.3 2.6 2.7 3.8 4.4 1.7 4.6-1.1 0.2-0.2z"
              id="TWN1165"
              name="Miaoli"
            ></path>
            <path
              d="M897.4 413.2l-4.2 1.7-5.8-0.1-4.8-1-3.7-3.3-3.8-4.3-5.8-4.6-3.9-6.7 1.5-7.4-1.2-6.3-5.7-5.5-3.8-4.2 1.6-3 1.8-2.4 2.1-4.6 3.6-4 10.9-6.4 2.9-2.5 4-2 3.8 1.2 2.1 2.2-0.5 3.6 0.4 3.5 3.2 6.8 2.5 10 3.9 3.5 1.6 4.4-1.6 6.6 0.1 5.1 4.6 2.6 3.8 3.2-2 4.3-7.6 9.6z"
              id="TWN1166"
              name="Taipei City"
            ></path>
            <path
              d="M915.9 357.2l-4.4 2.9-7.2 3.1-3.2 2.2 0.6 2.9 2.9 3.7 1.7 3.5 2.8 3.5 3.7 3.4 3 2.2 10.6 4.4 5.1 0.6 4-1.5 2.5-1.8 0.4-2.5-3.7-3.9-0.2-3 0.3-11.9 34.6 8.4 3.2 2-1.6 3.7-0.4 2.9 0.7 5.2 2.4 8.7 2.6 4.1 2.2 0.9 7-1 3.6 0.4 4.2 1.1 3.7 1.9 2 2.5-8.7 4.3-0.8-1.1-3.3-1.9-5.9 1.3-8.4 4.4-3.7 2.5-11.2 2.3-1.4 2.9 2.5 3.6-1.6 3.8-4.6 2.9-3.5 1.2-3.7 2-3.3 4.1-3.1 5-5 3.6-6.2 1.9-13.5 8.1-13 5.3-3.8 2.3-4.7 4-2 4.9 0.2 4.2 1 3.2 0.4 2-3.9 2.8-6.6 3.2-5 3.5-3.8 3.3-4.9 1.8-5.7 1.6-2.5-5.4-8.9-8.5-1.4-5.6-0.8-5.2 3.1-3.7 1.5-5.3-8.5-12.3-5-2-7.4 0.4-5.1-2.9 1.3-6.7-1-5.1-5.4-5.1-1-5.1 1-5.8-0.2-6.2 3.7-4 13.1-3.9 3.3-3.4 1-4.2-0.5-4.1-5.1-7.5-4.2-2.2-4.1-1-3.2-2.8-4.7-3.1-6.3-3-4.2-4.6 11.2-2.1 4.8-1.8 6.1-5.2 1.9-0.9 2.2-0.4 3.1 0 3.5 1.1 1.9 2.7 1.2 2.7 1.5 1.6 3.5-1.4-3.6-5.7-5.8-5.9-3.1-1.9 0.9-2.7 1.8-1.5 1.9-0.9 0.8-1 2.1-5.1 3.2-5.9 6.6-5.9 9.6-4.9 11-2.5 10.8 1.2 4.5 3.4 10 14.2 3.6 7.4 1.2-0.5 2.7-0.7 3-0.4 2.2 0.6-0.1 0.9-1.1 1.3-1 1.8 0.1 2.2 1.1 1.2 2.3 1.7z m-18.5 56l7.6-9.6 2-4.3-3.8-3.2-4.6-2.6-0.1-5.1 1.6-6.6-1.6-4.4-3.9-3.5-2.5-10-3.2-6.8-0.4-3.5 0.5-3.6-2.1-2.2-3.8-1.2-4 2-2.9 2.5-10.9 6.4-3.6 4-2.1 4.6-1.8 2.4-1.6 3 3.8 4.2 5.7 5.5 1.2 6.3-1.5 7.4 3.9 6.7 5.8 4.6 3.8 4.3 3.7 3.3 4.8 1 5.8 0.1 4.2-1.7z"
              id="TWN1167"
              name="New Taipei City"
            ></path>
            <path
              d="M861.8 498.8l-3.1 0.9-5.4 3.9 3.1 12.4-2.2 3.8-3.4 1.3-3.3-0.6-3.9 1.6-0.5 1.5-4.8-2.2-7.3-4.1-4-2.9-5.5-0.9-6.2-3.8-5.2-3.9-0.5-4.3 4.6-6.5 1.9-7.8-1.6-7.3-0.4-5-3.4-2.6-4.3-2.2-2.6-4.5-3.4-3.5-3.9 0.3-3.8-0.7-3.1-3.1-4.2-3.1-6.5-2.1-3.5-3.7 1.1-5.8-3.6-4.2-6.8-2.2-4.1-2-4.3-1.2-5-2-4-8.7-4.6-3.1-13.7 1-3.1-1.1 8.9-14.2 6.9-8.3 7.2-6.1 18.4-6.1 4.3-2.7 3.7-3.2 4.5-2.5 9-3.2 20.1-3.6 4.2 4.6 6.3 3 4.7 3.1 3.2 2.8 4.1 1 4.2 2.2 5.1 7.5 0.5 4.1-1 4.2-3.3 3.4-13.1 3.9-3.7 4 0.2 6.2-1 5.8 1 5.1 5.4 5.1 1 5.1-1.3 6.7 5.1 2.9 7.4-0.4 5 2 8.5 12.3-1.5 5.3-3.1 3.7 0.8 5.2 1.4 5.6 8.9 8.5 2.5 5.4z"
              id="TWN1168"
              name="Taoyuan"
            ></path>
            <path
              d="M647.2 689.6l0.1 3.6-4.3 1.6-1.2 2.9 0.5 4-2 4.6-1.6 5.4-0.1 5.7-1.2 6.6-0.9 13.4 2.1 6.3 3.6 3.3 3.9 1.4 5.6 2.9-1 3.5-3.8 1.5-2.5 2.3-2.4 1.6-1 0.7-12-2.4-5.8 0.1-12.2-6-19.7-2.3-11.6-4.4-6.6-1.8-7.6-0.4-22 2.6-7.6-4.4 0.8-1.4 1.6-7.1 1.2-3 7.1-6.8 2-2.8 2.7-7.8 4.2-7.7 5.7-16.1 2.7-4.7 3-3 2.5-1.7 2.2-1.1 1.6-1.4 0.6-3 1.2-2.8 5.1-4 1.2-3 0.6-10.1 0.9-2.8 2.7-2.6 11.3-13.2 5.8 1.9 4 3.5 2.7 6.3 1 7.6 4.5 5.4 11.9 3.5 4.3 3.6 3.2 5 2 4 0.1 4 1.2 3.3 4.3 0.8 5.4 3.5 0 1.4z"
              id="TWN1169"
              name="Changhua"
            ></path>
            <path
              d="M499.6 893.2l-1.8 1.4-0.4-1.1 2.4-3.1 0.9-2.4 1.1-1.5 0.6 0.5 0.1 1.1-1.4 2-1.5 3.1z m2.2-12.6l-0.7-0.7 2-3.8 0.9-0.4-0.5 1.9-1.7 3z m4.9-9l-0.1-4.4 0.5 0.4 0.1 2.9-0.5 1.1z m1.4-9.7l-0.8 1.6-0.5-2 1.3 0.4z m-1.3-6.1l-0.5 1.3-1.3-2.1 1.8 0.8z m-29.8 1l-3.2 1.6 3.8-5.4 13.9-14.1 10.6-13.5 2.5-0.8-9 14.7-4.5 4.5-2.9 3.5-3.8 3.8-3 2.1-4.4 3.6z m189.5-51.1l6.1 0.7 6.8 2.6 4.1 1.2 5.1 2.8-0.3 5.3-3 5.1 1.2 4.8 2.7 6.5 0.4 5.9 1.1 3.8 7.6 1.4 25.6 0.2 0.9 0.2-18.5 9.4-8.5 6.8-3.6 6.8-4.2 5-7.7 4.3-7.9 6.1-4.5 5.4-12.3 7.3-5.8 0.6-6.9-0.7-3.6 3.5-0.1 5 1.4 4.5 1 6.7-8.4-1-3.7-1.1-5 0.6-5.3 2.4-3.8 0-4.5-3.5-1.6-4.6 1.8-14.2-1-7.5-9.9-10.1-1.7-5.1-2.1-4.2-4-2.4-7.2-2.4-8.5 0.5-15.2 2.8-7.8 3.5-6.1 4.6-4.7 4.8-6.6 5.1-5.8 3.6-2.5 4.9-6.2 2.8-7.2-1.8-8.9-1.3-5.2-2 3.8-0.3 3.3-1.4 1.4 0.5-0.9-3.2-2.2 1.6-1.8-0.5-2.5-0.1 0-3.3 2.4-5.6 3.7-0.3 5.4 0.1-3.7-10.5-4.1-8 1.9-3.7 0-1.9-3.1-1.5 0.4-1.8 1.8-2 0.9-2.6 4-5.2-8.5 0.5-0.2-8.7 11.6-1.4 8.3 4.7 6.1 0.1 3.9-3.2 1.7-4.9 2.1-3 5.3-0.8 7-5.7 4.4-2.4 3.8-3.8 16.3-9.4 7.2-2 12.6-2.3 6.9-0.4 5.3 4.6 5 5.9 12.6 4.6 3.7-0.5 8.3-2.4 4.7 3.4 2.4 3.9 6.3-0.6 11.7-2.4 4-1.3 0-3.4 0.3-5 0.5 0z m-92.7 30.8l-3.8 4.1 0.9 5.6 6.1 2.4 7 4.5 7.3 1.7 6.8-2.7 4.5-0.6 3-2.2-2.5-6.8-2.5-4-4.1-2.2-5.6-2.1-7.8 0.7-9.3 1.6z"
              id="TWN1170"
              name="Chiayi"
            ></path>
            <path
              d="M573.8 836.5l9.3-1.6 7.8-0.7 5.6 2.1 4.1 2.2 2.5 4 2.5 6.8-3 2.2-4.5 0.6-6.8 2.7-7.3-1.7-7-4.5-6.1-2.4-0.9-5.6 3.8-4.1z"
              id="TWN1171"
              name="Chiayi City"
            ></path>
            <path
              d="M935.4 601.5l0.6 0.8 1.6 2.9 0.2 1.1-1.4 2.4-5.8 5.7-6.2 8.6-4.7 3.7-1.4 2 0.7 2.1-0.9 1.5-6.6 5.1-2.5 2.4-2.8 6-2.9 12.2-7.4 10.9-1.5 4.4 0.2 4.7 1.8 5.2 1.5 2.3 1.3 1 0.8 1.4 0.1 3.2-1.1 3.6-3.7 5.8-0.7 3.5-0.4 6.4-3.2 16.3-6.4 17-8 40.1-4.8 9.8-11 64.1-3.5-1-10.8 5.2-3.9 5.4 1.7 6.9 0.6 6.9-3.6 6.9-3.4 5.2-2.7 6.6-2.4 8.4-3.7 7.7-4.8 13.2-3.1 6.1 0.1 6.7-0.9 6.2-6.5 3.7-8.2-1.1-11.7-9.7-9.2-16-5.7-1.5-6.3-0.9-5-4.8-6.1-2.9-7.8-2.8-5-8.1-1.2-7.4-0.3-2.5-2.8-7.6-6.3-5.2-5.6-3.6-1-4 1.4-3.2 5.6-2.4 3-5-1.9-5.8 6-3.5 3.1-2.8-1.7-6.2 1.5-2.7 1.5-4 5.2-3.9 7.4-1.6 7.4-0.3 5.3-4.7 1.3-8.5 4-5.2 7.6-2.8 4.5-3.1 1.6-5.1 3.2-12.6 1.2-8.4-0.9-7.2-1.2-5.4-3.2-4.1-2.1-4 5.7-9.4 0.2-3.7 2.5-7 3.9-8.5 3-8.8 1.6-9.9 0.6-7.6-1.8-4.5-2-3.3 2.3-7.6 5.1-10.7 8-10.4 0.3-3.9-1.5-4.5-5.2-3.4-2.9-3.1-0.2-9.9 3.7-2.9 6.6-2.2 5.2-2.4-0.2-3.7-1.4-6.2 2.8-2 1.2-2.1 3.4-1.7 3.1-3.8 1.3-5.1 3-5 7.5-4.7 2.4-6.2 0.4-4.2 4.7-4.9 2.5 2.1 6.5 3.1 15 3.8 8.3 3.2 6.5 0 4.9-4.5 2.4-6 3.8-0.9 18.5 11.1 11.1 1.7 1.1 0z"
              id="TWN1172"
              name="Hualien"
            ></path>
            <path
              d="M825 627.6l1.4 6.2 0.2 3.7-5.2 2.4-6.6 2.2-3.7 2.9 0.2 9.9 2.9 3.1 5.2 3.4 1.5 4.5-0.3 3.9-8 10.4-5.1 10.7-2.3 7.6 2 3.3 1.8 4.5-0.6 7.6-1.6 9.9-3 8.8-3.9 8.5-2.5 7-0.2 3.7-5.7 9.4 2.1 4 3.2 4.1 1.2 5.4 0.9 7.2-1.2 8.4-3.2 12.6-1.6 5.1-4.5 3.1-7.6 2.8-4 5.2-1.3 8.5-5.3 4.7-7.4 0.3-7.4 1.6-5.2 3.9-1.5 4-1.5 2.7 1.7 6.2-3.1 2.8-6 3.5-0.7-2-4.2-5.9-5.8-2.2-4.3-1-0.9-0.2-25.6-0.2-7.6-1.4-1.1-3.8-0.4-5.9-2.7-6.5-1.2-4.8 3-5.1 0.3-5.3-5.1-2.8-4.1-1.2-6.8-2.6-6.1-0.7-2.6-3.5-8.2 0.9-6.8 2-5.8-2.5-4-4.7 0.9-5.7 1.9-5.2-1-7.7 1-7.2 2-4.7-1.9-7.2 2.4-1.6 2.5-2.3 3.8-1.5 1-3.5-5.6-2.9-3.9-1.4-3.6-3.3-2.1-6.3 0.9-13.4 1.2-6.6 0.1-5.7 1.6-5.4 2-4.6-0.5-4 1.2-2.9 4.3-1.6-0.1-3.6 4.3 0.2 17.9 2.5 4.2-0.6 5-4.8 7.6-14.4 3.7-8.5 6.4-3 10.1 1.4 6-0.2 5.8-7.7 3-1.9 8.9 6.7 3.5-0.9 2.6-5.5 4.7-3.9 6.6 0.1 5-1.9 7.9-7.6 5.1-2.9 4.4-0.8 8.8-4.7 6.2-0.2 6.3-1 11.1-4.4 4.6-0.3 4.7 1 13.4 1.3z"
              id="TWN1173"
              name="Nantou"
            ></path>
            <path
              d="M803.7 570.5l0.8-0.6 10.6-1 2.8 0.8 3.6 1-0.6 5.5 1.4 3.8 4.9 1 4.4 2.6 3.7 2.5 4-0.6 4.7-2.3 4.9 0 5.9 4.7-4.7 4.9-0.4 4.2-2.4 6.2-7.5 4.7-3 5-1.3 5.1-3.1 3.8-3.4 1.7-1.2 2.1-2.8 2-13.4-1.3-4.7-1-4.6 0.3-11.1 4.4-6.3 1-6.2 0.2-8.8 4.7-4.4 0.8-5.1 2.9-7.9 7.6-5 1.9-6.6-0.1-4.7 3.9-2.6 5.5-3.5 0.9-8.9-6.7-3 1.9-5.8 7.7-6 0.2-10.1-1.4-6.4 3-3.7 8.5-7.6 14.4-5 4.8-4.2 0.6-17.9-2.5-4.3-0.2 0-1.4-5.4-3.5-4.3-0.8-1.2-3.3-0.1-4-2-4-3.2-5-4.3-3.6-11.9-3.5-4.5-5.4-1-7.6-2.7-6.3-4-3.5-5.8-1.9 0.6-0.8 0.8-3.3 3.3-2.7 2.2-6.5 2.7-12.3 9.3-16.1 2.8-9.9 3.4-5.5 13.3-14.8 9.2 14.3 4.7 5 6.3 5.5 15.1 11.1 7.3 3.6 6.6 1.2 11.6 6.7 12.1-0.7 5.2-2.8 0.9-7.4 5.5-3.3 9.9 0.8 6 2.4 5 5.6 5.4 2.1 8.9-4.7 6.8-2.9 11.6-9.2 5.9-3.2 4.6-4.4 4.2-3 5.3 0.1 4.9-2 1.8-5.6 3.7-2.6z"
              id="TWN1174"
              name="Taichung City"
            ></path>
            <path
              d="M642 760.2l1.9 7.2-2 4.7-1 7.2 1 7.7-1.9 5.2-0.9 5.7 4 4.7 5.8 2.5 6.8-2 8.2-0.9 2.6 3.5-0.5 0-0.3 5 0 3.4-4 1.3-11.7 2.4-6.3 0.6-2.4-3.9-4.7-3.4-8.3 2.4-3.7 0.5-12.6-4.6-5-5.9-5.3-4.6-6.9 0.4-12.6 2.3-7.2 2-16.3 9.4-3.8 3.8-4.4 2.4-7 5.7-5.3 0.8-2.1 3-1.7 4.9-3.9 3.2-6.1-0.1-8.3-4.7-11.6 1.4 4.6-5.2-0.2-16.4 0.7-12.3 2.8-9.8 4.3-7.7 1.3-10 2.3-8.8 1.3-3 6.1-8.1 1.1-2.8 0.7-1.5 5.6-4.3 0.8-1.6 7.6 4.4 22-2.6 7.6 0.4 6.6 1.8 11.6 4.4 19.7 2.3 12.2 6 5.8-0.1 12 2.4 1-0.7z"
              id="TWN1176"
              name="Yunlin"
            ></path>
            <path
              d="M889.2 1263l-5.5 1.7-7.3-2.9-6.8-4.8-3.9-3.7 1.2-2.7-0.1-2.5-1-2.4-1.7-2.1 19.5 0 0 1.8-1.3 3.5-0.4 2.9 0.9 2.5 4.7 3.5 2 2.5-0.3 2.7z m-24-177.6l-0.1 1.1-3.4-0.4-0.4-0.6-2.7-1-2.8-4.9-1.4-4.3 0.6-0.6 10-0.7 1.1 0.6 0.8 2-0.8 3.9-0.9 1.6-0.4 1.7 0.4 1.6z m-163.1 114.1l-4.5 0.3-10.2-4.7-4.6-4.9-3.2-5.9-0.6-6.1 0.1-5.7-3.1-4.4-3.4-1.7-2.7-3.9 0.5-4.5 2.1-3.9 5.3-3.2 2.5-3.8-4.6-5.6-2.6-5 0-5.4-1.1-7.1-2-6.1-1.2-6.5 0.8-14.7 3-7.5 3.7-6.6 2.4-6.6 5.4-4.5 7.6-1.6 4.8-2.7 9.8-4.1 2-5 0.1-5.2 2.8-13.8-5.5-3.6-5.4-1.3-0.7-4.9-3.5-6.6 3.9-0.5-1.2-4.9-6.2-6.4-3-4.6-1.3-8.1 2.3-9.8 8.5-7.2 4.3-5.9 0.1-11.2 3-13.2-2.1-9.9 0.8-6.9 7.4-4 2.7-4.9-2.3-6 0.9-5.7 7.8-5.1 4-3.9 6.4-4.1 15.6-3.8 1.2 7.4 5 8.1 7.8 2.8 6.1 2.9 5 4.8 6.3 0.9 5.7 1.5 9.2 16 11.7 9.7 8.2 1.1 6.5-3.7 0.9-6.2-0.1-6.7 3.1-6.1 4.8-13.2 3.7-7.7 2.4-8.4 2.7-6.6 3.4-5.2 3.6-6.9-0.6-6.9-1.7-6.9 3.9-5.4 10.8-5.2 3.5 1-4.6 26.4-2.2 4.9-7.1 9.4-2.6 4.9-2.1 6.1-1.5 11.4 0.2 10.2-1 9.7-4.9 9.9-2.1 2.1-4.7 3.5-2.2 2.2-1 2.3-1.7 5.8-4.8 8.4-2.9 13.1-2.1 5.9-10.3 14.8-1.3 2.7-13.9 11.8-3.3 3.8-0.4 2.7 0.6 6.2-0.2 2.8-1.2 3.2-2.2 3.5-4.7 6.1-4.7 4.5-16.1 10.7-10.8 11.9-2.7 1.4-2.1 2.7-5.2 13.5-2.6 5-8 10-3.3 6-1.9 12.3-4.8 16.8-9.5 16.7-1.4 5.7-1.7 16.1 0.3 14.7z"
              id="TWN1177"
              name="Taitung"
            ></path>
            <path
              d="M320.7 926.5l-1.8 0.9-1.3-1.5-1.5-4.7 1-1.2 3.8-1.3 2.7 0.7 0.1 2.1-0.2 1.6-1.2 1.2-1.6 2.2z m-1.2-12l-1.7 3.1-2.2-0.6-2-2.5-0.3-2.5 1.2-1.1 3.2 0.5 1.8 3.1z m48.8-3.2l-0.4 0.1-1.2-1.5 0.3-0.6 2.5-0.2 0.8 2-2 0.2z m14-4.6l0.3 0.2 2.3 0 0 1.3-1.1 1.5-0.7 1.8-1.1-2.8 0.3-2z m-33.5-29.6l-1.7 0.1-3 1.8-0.4-0.4 0.4-1.3 1.1-1.5 0.7-0.6 1.6-0.3 1.5 0.9-0.2 1.3z m-8.4-6.7l0.1 2.3 0.5 1.6 1.4 1.2-0.6 1.6-1.2 1.2 0.6 1.9-1.5 0.6-3.1-0.3-1.6-0.7 1.4-3.1-0.2-4.2-0.9 0.6-2 0.6-0.6-2.3 2.1-5.1 1.6-0.3 2.7 3.6 1.3 0.8z m-49.5-5.7l2.4 0.6 0 1.6-0.6 0.9-2.1 0.6-1.1-1.1 1.4-2.6z m58.5-24.8l-3.2 2.1-2.1 0.6-2.2 1.1-1.3-0.5-0.3-1.8 0.7-0.6 1.8 0.5 4-2 2.6 0.6z m19.5-28l-0.6 1.3 4-1.3 3.1 0.4 2.3-0.2 1.6-2.7 4.7 8.7 1.2 4-0.5 3-2-2-2.5-1.7-2.8-0.5-4 2.2-2.8 0.3-1.4 0.8-0.7 1.5-1.1 4.1-0.7 1.2-4.7 2.7-4.8 0.7-4.8-1.9-4.9-4.9 1.3-2.5 2.7 3.2 4 0.9 4.3-1.2 3.5-2.9-2.4-0.9-2-1.2-1.5-1.6-1.4-2.2-0.8 1.4-1 0.6-0.3-4 0.3-4 1.8 0 2.1 0.5 7.4-4.6 4.6-1.6-1.2 4.4z m-39.9 9.3l-3.8 0 0.7-2.1 1.2-1.3 1.9-0.5 2.5-0.2 2.2-0.9 0.6-2 0.1-4.8 3.2-10.4 3.1-3 4.2 3.6-2.5 1.5-1.7 3.6-2.8 8.5-0.1 2.2 0.7 2-0.3 1.3-3 0.5-2.2 0.1-1.5 0.3-1.3 0.6-1.2 1z m33.8-17.9l-2.2 0.7-1.1-1.5-0.9-3.5-2-2.9-4.3-4.3 5.5-4.1 3.3 1.7 3.2 2.8 1.4 2.9-2.5 2.4 1 3.5-1.4 2.3z m2.6-30.4l-0.3 0.9-1.3-3-0.2-1.4 1.8-1.5 1.6-3 0.5 1.1 2.5 1.4-0.4 1.8-2.2 1.3-2 2.4z"
              id="TWN3414"
              name="Penghu"
            ></path>
            <path
              d="M9.2 576.4l-5.2 1.5-3-1.2 5-9.9 1.3-1.4 2.1-0.5 2.1-0.1 2 1.4 1.6 1.8 0 3.1-1.4 2.1-1.6 0.1-1.1 1.2-0.6 1.2-1.2 0.7z m55-26.8l4.7 12.6-1 8.8-3.9 4.6-6.8-4.3-5-1.6-8.1 0.8-7.1 4.5-3.9 6.1-3.4 1.7-3.9-1.9-2.7-0.1-2.4-1.1-1.2-2.1 0.5-0.7 2.1-2.8 0.7-1.2 0.2-2.1-0.1-2.5-0.7-4.3-1.8-4.2-0.2-2.1 1.5-0.9 7.6-3.7 10 6.6 7-0.9 1.1-8.7 2.3-5.5 7.5-1.5 7 6.5z m269.3-137.7l-2.9 1.5-1.3-1.2 0.7-3.2 2.4-1.4 1.7 0.3 0.2 1.9-0.8 2.1z"
              id="TWN3415"
              name="Kinmen"
            ></path>
            <path
              d="M469.2 123.9l-0.2 2.3-1.9 2.1-4.1 2 2.5-5.6 2.5 0.5 0.1-0.9 1.1-0.4z m-11.8-0.8l-2 2.1-2.4-3.4 3.6-1.3 2.7 1.5-1.9 1.1z m-3.2-54.9l1 0.5 4.4-2.6 2.8 0 0 1.8-2.8 3.2-5.5 2.9-1.7 0.3-2.5-1.7-0.8-2.4 0.5-2.8 1.1-2 1-0.2 0.3 2.2 2.2 0.8z m21.3-17.8l-0.6 2.2 0.6 1.2-1.4-0.2-1.5-2.2-1.1-0.7-2.3 1.3-1-0.4-1.3 0.3-1.5 1.7-1.2 5-1.1-0.7-0.5-1.5 0.5-4.3 0.5-1.6 1.1-0.7 2.7-0.9 0.7-0.9 2.2-1.3 2.5 0.4 1.3 1.9 1.4 1.4z m129.8-45.6l-1.2 0.4-1.1-0.4-1.4 1.3-1.1 2.1-0.3-0.5-1.2-0.2-1.8-1 1.1-1.7-0.5-1.4 0.9-0.6 2.2-1.8 2.6 1.5 0.6 1.3 1.2 1z"
              id="TWN5128"
              name="Lienchiang"
            ></path>
            <circle cx="894" cy="358" id="0"></circle>
            <circle cx="669.9" cy="526.1" id="1"></circle>
            <circle cx="569.7" cy="1021.4" id="2"></circle>
          </svg>
          
        </div>
      </div>
      <div id="show_weather" >
          <div id="loc"></div> 
          <div>
          <img src="score_star.png" id="star"/>
          </div>
          <div id="score"></div>
          <div id="weatherTarget"></div>
          <div id="day"></div>
          <div id="maxmin"></div>
          <div id="sunRiseTime"></div>
          <div id="rain"></div>
          <div id="weather"></div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script type="text/javascript">
      window.onload = function () {
        // 獲取 <nav> 和 <main> 的元素引用
        const nav = document.querySelector("nav");
        const main = document.querySelector("main");
        const legend = document.querySelector(".legend");

        // 計算 <nav> 的高度
        const navHeight = nav.offsetHeight;

        // 設定 <main> 的高度為 "100vh" 減去 <nav> 的高度
        main.style.height = `calc(95vh - ${navHeight}px)`;
        legend.style.bottom = `calc(${navHeight}px + 5vh)`;
      };

      // 自立執行函數，用於初始化和定義日曆
      !(function () {
        var today = moment();

        function Calendar(selector, events) {
          this.el = document.querySelector(selector);
          this.events = events;
          this.current = moment().date(1);
          this.draw();
          var current = document.querySelector(".today");
          if (current) {
            var self = this;
            window.setTimeout(function () {
              self.openDay(current);
            }, 500);
          }
        }

        Calendar.prototype.draw = function () {
          //Create Header
          this.drawHeader();

          //Draw Month
          this.drawMonth();

          // this.drawLegend();
        };

        Calendar.prototype.drawHeader = function () {
          var self = this;
          if (!this.header) {
            //Create the header elements
            this.header = createElement("div", "header");
            this.header.className = "header";

            this.title = createElement("h1");

            var right = createElement("div", "right");
            right.addEventListener("click", function () {
              self.nextMonth();
            });

            var left = createElement("div", "left");
            left.addEventListener("click", function () {
              self.prevMonth();
            });

            //Append the Elements
            this.header.appendChild(this.title);
            this.header.appendChild(right);
            this.header.appendChild(left);
            this.el.appendChild(this.header);
          }

          this.title.innerHTML = this.current.format("MMMM YYYY");
        };

        Calendar.prototype.drawMonth = function () {
          var self = this;

          this.events.forEach(function (ev) {
            ev.date = moment(ev.date);
          });

          if (this.month) {
            this.oldMonth = this.month;
            this.oldMonth.className =
              "month out " + (self.next ? "next" : "prev");
            this.oldMonth.addEventListener("webkitAnimationEnd", function () {
              self.oldMonth.parentNode.removeChild(self.oldMonth);
              self.month = createElement("div", "month");
              self.backFill();
              self.currentMonth();
              self.fowardFill();
              self.el.appendChild(self.month);
              window.setTimeout(function () {
                self.month.className =
                  "month in " + (self.next ? "next" : "prev");
              }, 16);
            });
          } else {
            this.month = createElement("div", "month");
            this.el.appendChild(this.month);
            this.backFill();
            this.currentMonth();
            this.fowardFill();
            this.month.className = "month new";
          }
        };

        Calendar.prototype.backFill = function () {
          var clone = this.current.clone();
          var dayOfWeek = clone.day();

          if (!dayOfWeek) {
            return;
          }

          clone.subtract("days", dayOfWeek + 1);

          for (var i = dayOfWeek; i > 0; i--) {
            this.drawDay(clone.add("days", 1));
          }
        };

        Calendar.prototype.fowardFill = function () {
          var clone = this.current.clone().add("months", 1).subtract("days", 1);
          var dayOfWeek = clone.day();

          if (dayOfWeek === 6) {
            return;
          }

          for (var i = dayOfWeek; i < 6; i++) {
            this.drawDay(clone.add("days", 1));
          }
        };

        Calendar.prototype.currentMonth = function () {
          var clone = this.current.clone();

          while (clone.month() === this.current.month()) {
            this.drawDay(clone);
            clone.add("days", 1);
          }
        };

        Calendar.prototype.getWeek = function (day) {
          if (!this.week || day.day() === 0) {
            this.week = createElement("div", "week");
            this.month.appendChild(this.week);
          }
        };

        Calendar.prototype.drawDay = function (day) {
          var self = this;
          this.getWeek(day);

          //Outer Day
          var outer = createElement("div", this.getDayClass(day));
          outer.addEventListener("click", function () {
            self.openDay(this);
          });

          //Day Name
          var name = createElement("div", "day-name", day.format("ddd"));

          //Day Number
          var number = createElement("div", "day-number", day.format("DD"));

          //Events
          var events = createElement("div", "day-events");
          this.drawEvents(day, events);

          outer.appendChild(name);
          outer.appendChild(number);
          outer.appendChild(events);
          this.week.appendChild(outer);
        };

        Calendar.prototype.drawEvents = function (day, element) {
          if (day.month() === this.current.month()) {
            var todaysEvents = this.events.reduce(function (memo, ev) {
              if (ev.date.isSame(day, "day")) {
                memo.push(ev);
              }
              return memo;
            }, []);

            todaysEvents.forEach(function (ev) {
              var evSpan = createElement("span", ev.color);
              element.appendChild(evSpan);
            });
          }
        };

        Calendar.prototype.getDayClass = function (day) {
          let classes = ["day"];

          if (day.month() !== this.current.month()) {
            classes.push("other");
          } else if (today.isSame(day, "day")) {
            classes.push("today");
          }
          const diff = day.diff(today, 'days');

          if (diff >= 0 && diff <= 6) {
            classes.push("recommend_day");
          }

          return classes.join(" ");
        };

        function isWithinNext7Days(dateString) {
          const today = new Date();
          today.setHours(0, 0, 0, 0);

          const targetDate = new Date(dateString);
          targetDate.setHours(0, 0, 0, 0);

          const diffTime = targetDate - today;
          const diffDays = diffTime / (1000 * 60 * 60 * 24);

          return diffDays >= 0 && diffDays <= 6;
        }

       

        Calendar.prototype.openDay = function (el) {
          var details, arrow;
          var dayNumber =
            +el.querySelectorAll(".day-number")[0].innerText ||
            +el.querySelectorAll(".day-number")[0].textContent;
          var day = this.current.clone().date(dayNumber);

          var currentOpened = document.querySelector(".details");

          //Check to see if there is an open detais box on the current row
          if (currentOpened && currentOpened.parentNode === el.parentNode) {
            details = currentOpened;
            arrow = document.querySelector(".arrow");
          } else {
            //Close the open events on differnt week row
            //currentOpened && currentOpened.parentNode.removeChild(currentOpened);
            if (currentOpened) {
              currentOpened.addEventListener("webkitAnimationEnd", function () {
                currentOpened.parentNode.removeChild(currentOpened);
              });
              currentOpened.addEventListener("oanimationend", function () {
                currentOpened.parentNode.removeChild(currentOpened);
              });
              currentOpened.addEventListener("msAnimationEnd", function () {
                currentOpened.parentNode.removeChild(currentOpened);
              });
              currentOpened.addEventListener("animationend", function () {
                currentOpened.parentNode.removeChild(currentOpened);
              });
              currentOpened.className = "details out";
            }

            //Create the Details Container
            details = createElement("div", "details in");

            //Create the arrow
            var arrow = createElement("div", "arrow");

            //Create the event wrapper

            details.appendChild(arrow);
            el.parentNode.appendChild(details);
          }

          var todaysEvents = this.events.reduce(function (memo, ev) {
            if (ev.date.isSame(day, "day")) {
              memo.push(ev);
            }
            return memo;
          }, []);
          var recom;
          if (todaysEvents.length > 0 && todaysEvents[0].date && todaysEvents[0].date._i) {
            recom = isWithinNext7Days(todaysEvents[0].date._i);
          } else {
            recom = false;
          }

          this.renderEvents(todaysEvents, details, recom);

          arrow.style.left =
            el.offsetLeft - el.parentNode.offsetLeft + 27 + "px";
        };

        Calendar.prototype.renderEvents = function (events, ele, recom) {
          //Remove any events in the current details element
          var currentWrapper = ele.querySelector(".events");
          var wrapper = createElement(
            "div",
            "events in" + (currentWrapper ? " new" : "")
          );

          events.forEach(function (ev) {
            var div = createElement("div", "event");
            var square = createElement("div", "event-category " + ev.color);
            var search=ev.eventName.split(", ")[1].split("，")[0];
            var span = createElement("span", "", ev.eventName.split(", ")[0]+", ");
            var a=createElement("a", search, ev.eventName.split(", ")[1]);

            a.href="./knowledge.php?search="+search;
            span.appendChild(a);
            div.appendChild(square);
            div.appendChild(span);
            if(recom){
              var recommend_btn = createElement("div", "recommend_btn", "地點推薦");
              recommend_btn.addEventListener("click", function () {
                
                loc_recommend(ev);
                
              });
              div.appendChild(recommend_btn);
            }
            
            wrapper.appendChild(div);
          });

          if (!events.length) {
            var div = createElement("div", "event empty");
            var span = createElement("span", "", "本日無特殊天象");

            div.appendChild(span);
            wrapper.appendChild(div);
          }

          if (currentWrapper) {
            currentWrapper.className = "events out";
            currentWrapper.addEventListener("webkitAnimationEnd", function () {
              currentWrapper.parentNode.removeChild(currentWrapper);
              ele.appendChild(wrapper);
            });
            currentWrapper.addEventListener("oanimationend", function () {
              currentWrapper.parentNode.removeChild(currentWrapper);
              ele.appendChild(wrapper);
            });
            currentWrapper.addEventListener("msAnimationEnd", function () {
              currentWrapper.parentNode.removeChild(currentWrapper);
              ele.appendChild(wrapper);
            });
            currentWrapper.addEventListener("animationend", function () {
              currentWrapper.parentNode.removeChild(currentWrapper);
              ele.appendChild(wrapper);
            });
          } else {
            ele.appendChild(wrapper);
          }
        };

        // Calendar.prototype.drawLegend = function () {
        //   var legend = createElement("div", "legend");
        //   var calendars = this.events
        //     .map(function (e) {
        //       return e.calendar + "|" + e.color;
        //     })
        //     .reduce(function (memo, e) {
        //       if (memo.indexOf(e) === -1) {
        //         memo.push(e);
        //       }
        //       return memo;
        //     }, [])
        //     .forEach(function (e) {
        //       var parts = e.split("|");
        //       var entry = createElement("span", "entry " + parts[1], parts[0]);
        //       legend.appendChild(entry);
        //     });
        //   this.el.appendChild(legend);
        // };

        Calendar.prototype.nextMonth = function () {
          this.current.add("months", 1);
          this.next = true;
          this.draw();
        };

        Calendar.prototype.prevMonth = function () {
          this.current.subtract("months", 1);
          this.next = false;
          this.draw();
        };

        window.Calendar = Calendar;

        function createElement(tagName, className, innerText) {
          var ele = document.createElement(tagName);
          if (className) {
            ele.className = className;
          }
          if (innerText) {
            ele.innderText = ele.textContent = innerText;
          }
          return ele;
        }
      })();

      !(function () {
        var data = [
          {
            eventName: "06:16, 天王星合月，天王星在月球南方 0.71 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-02",
          },
          {
            eventName: "03:37, 火星合月，火星在月球北方 0.54 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-04",
          },
          {
            eventName: "00:17, 地球過近日點",
            calendar: "Other",
            color: "green",
            date: "2023-01-05",
          },
          {
            eventName: "07:08, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-01-07",
          },
          {
            eventName: "20:57, 水星下合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-07",
          },
          {
            eventName: "17:19, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-01-08",
          },
          {
            eventName: "04:12, 火星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-13",
          },
          {
            eventName: "10:10, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-01-15",
          },
          {
            eventName: "19:49, 水星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-18",
          },
          {
            eventName: "15:49, 水星合月，水星在月球北方 6.94 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-20",
          },
          {
            eventName: "04:53, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-01-22",
          },
          {
            eventName: "04:57, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-01-22",
          },
          {
            eventName: "04:00, 金星合土星，金星在土星南方 0.37 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-23",
          },
          {
            eventName: "10:52, 天王星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-23",
          },
          {
            eventName: "15:21, 土星合月，土星在月球北方 3.83 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-23",
          },
          {
            eventName: "16:18, 金星合月，金星在月球北方 3.45 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-23",
          },
          {
            eventName: "13:55, 海王星合月，海王星在月球北方 2.69 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-25",
          },
          {
            eventName: "10:03, 木星合月，木星在月球北方 1.81 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-26",
          },
          {
            eventName: "23:19, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-01-28",
          },
          {
            eventName: "12:09, 天王星合月，天王星在月球南方 0.95 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-29",
          },
          {
            eventName: "13:54, 水星西大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-30",
          },
          {
            eventName: "12:25, 火星合月，火星在月球北方 0.11 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-01-31",
          },
          {
            eventName: "10:50, 刻天王星東方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-04",
          },
          {
            eventName: "16:55, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-02-04",
          },
          {
            eventName: "02:29, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-02-06",
          },
          {
            eventName: "00:01, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-02-14",
          },
          {
            eventName: "20:00, 金星合海王星，金星在海王星南方 0.01 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-15",
          },
          {
            eventName: "00:48, 土星合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-17",
          },
          {
            eventName: "04:52, 水星合月，水星在月球北方 3.60 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-19",
          },
          {
            eventName: "17:06, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-02-19",
          },
          {
            eventName: "07:58, 土星合月，土星在月球北方 3.69 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-20",
          },
          {
            eventName: "15:06, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-02-20",
          },
          {
            eventName: "02:16, 海王星合月，海王星在月球北方 2.36 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-22",
          },
          {
            eventName: "15:55, 金星合月，金星在月球北方 2.09 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-22",
          },
          {
            eventName: "06:00, 木星合月，木星在月球北方 1.19 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-23",
          },
          {
            eventName: "08:39, 天王星合月，天王星在月球南方 1.27 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-02-25",
          },
          {
            eventName: "18:00, 刻水星合土星，水星在土星南方 0.93 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-02",
          },
          {
            eventName: "19:00, 金星合木星，金星在木星北方 0.54 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-02",
          },
          {
            eventName: "02:00, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-04",
          },
          {
            eventName: "20:40, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-07",
          },
          {
            eventName: "10:08, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-15",
          },
          {
            eventName: "07:39, 海王星合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-16",
          },
          {
            eventName: "23:00, 水星合海王星，水星在海王星南方 0.42 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-16",
          },
          {
            eventName: "02:10, 火星東方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-17",
          },
          {
            eventName: "18:45, 水星上合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-17",
          },
          {
            eventName: "23:12, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-19",
          },
          {
            eventName: "23:22, 土星合月，土星在月球北方 3.60 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-19",
          },
          {
            eventName: "14:47, 海王星合月，海王星在月球北方 2.36 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-21",
          },
          {
            eventName: "01:23, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-22",
          },
          {
            eventName: "08:10, 水星合月，水星在月球北方 1.83 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-22",
          },
          {
            eventName: "03:56, 木星合月，木星在月球北方 0.53 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-23",
          },
          {
            eventName: "18:27, 金星合月，金星在月球北方 0.11 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-24",
          },
          {
            eventName: "08:39, 天王星合月，天王星在月球南方 1.53 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-25",
          },
          {
            eventName: "21:16, 火星合月，火星在月球南方 2.29 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-28",
          },
          {
            eventName: "23:00, 水星合木星，水星在木星北方 1.46 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-28",
          },
          {
            eventName: "12:32, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-29",
          },
          {
            eventName: "14:00, 金星合天王星，金星在天王星北方 1.29 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-03-31",
          },
          {
            eventName: "19:17, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-03-31",
          },
          {
            eventName: "12:34, 刻望",
            calendar: "Moon",
            color: "orange",
            date: "2023-04-06",
          },
          {
            eventName: "06:07, 木星合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-12",
          },
          {
            eventName: "06:10, 水星東大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-12",
          },
          {
            eventName: "17:11, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-04-13",
          },
          {
            eventName: "10:24, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-04-16",
          },
          {
            eventName: "11:49, 土星合月，土星在月球北方 3.49 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-16",
          },
          {
            eventName: "01:24, 海王星合月，海王星在月球北方 2.31 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-18",
          },
          {
            eventName: "01:31, 木星合月，木星在月球南方 0.12 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-20",
          },
          {
            eventName: "12:12, 朔(日環-全食，國內各地可見日偏食)",
            calendar: "Other",
            color: "green",
            date: "2023-04-20",
          },
          {
            eventName: "15:05, 水星合月，水星在月球北方 1.90 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-21",
          },
          {
            eventName: "21:00, 天王星合月，天王星在月球南方 1.69 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-21",
          },
          {
            eventName: "00:01, 水星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-22",
          },
          {
            eventName: "21:03, 金星合月，金4",
            calendar: "Planet",
            color: "blue",
            date: "2023-04-23",
          },
          {
            eventName: "05:20, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-04-28",
          },
          {
            eventName: "14:43, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-04-28",
          },
          {
            eventName: "07:28, 刻水星下合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-02",
          },
          {
            eventName: "01:34, 望(半影月食，國內各地全程可見)",
            calendar: "Other",
            color: "green",
            date: "2023-05-06",
          },
          {
            eventName: "03:56, 天王星合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-10",
          },
          {
            eventName: "13:05, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-05-11",
          },
          {
            eventName: "22:28, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-05-12",
          },
          {
            eventName: "21:07, 土星合月，土星在月球北方 3.29 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-13",
          },
          {
            eventName: "14:44, 水星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-14",
          },
          {
            eventName: "09:25, 海王星合月，海王星在月球北方 2.21 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-15",
          },
          {
            eventName: "21:18, 木星合月，木星在月球南方 0.80 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-17",
          },
          {
            eventName: "09:35, 水星合月，水星在月球南方 3.59 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-18",
          },
          {
            eventName: "23:53, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-05-19",
          },
          {
            eventName: "08:22, 天王星合月，天王星在月球南方 1.82 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-19",
          },
          {
            eventName: "20:08, 金星合月，金星在月球南方 2.21 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-23",
          },
          {
            eventName: "01:32, 火星合月，火星在月球南方 3.76 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-25",
          },
          {
            eventName: "09:39, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-05-26",
          },
          {
            eventName: "23:22, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-05-27",
          },
          {
            eventName: "18:46, 土星西方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-28",
          },
          {
            eventName: "13:34, 水星西大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-05-29",
          },
          {
            eventName: "13:00, 水星合天王星，水星在天王星南方 2.90 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-04",
          },
          {
            eventName: "11:42, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-06-04",
          },
          {
            eventName: "19:01, 金星東大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-04",
          },
          {
            eventName: "07:06, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-06-07",
          },
          {
            eventName: "04:23, 土星合月，土星在月球北方 2.98 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-10",
          },
          {
            eventName: "03:31, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-06-11",
          },
          {
            eventName: "15:46, 海王星合月，海王星在月球北方 2.00 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-11",
          },
          {
            eventName: "14:35, 木星合月，木星在月球南方 1.51 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-14",
          },
          {
            eventName: "17:54, 天王星合月，天王星在月球南方 2.00 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-15",
          },
          {
            eventName: "04:38, 水星合月，水星在月球南方 4.31 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-17",
          },
          {
            eventName: "12:37, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-06-18",
          },
          {
            eventName: "23:13, 土星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-18",
          },
          {
            eventName: "11:54, 海王星西方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-19",
          },
          {
            eventName: "08:48, 金星合月，金星在月球南方 3.69 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-22",
          },
          {
            eventName: "18:09, 火星合月，火星在月球南方 3.80 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-06-22",
          },
          {
            eventName: "02:30, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-06-23",
          },
          {
            eventName: "15:50, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-06-26",
          },
          {
            eventName: "13:06, 刻 水星上合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-01",
          },
          {
            eventName: "21:25, 海王星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-01",
          },
          {
            eventName: "19:39, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-07-03",
          },
          {
            eventName: "06:25, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-07-05",
          },
          {
            eventName: "04:07, 地球過遠日點",
            calendar: "Other",
            color: "green",
            date: "2023-07-07",
          },
          {
            eventName: "11:10, 土星合月，土星在月球北方 2.67 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-07",
          },
          {
            eventName: "22:12, 海王星合月，海王星在月球北方 1.72 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-08",
          },
          {
            eventName: "09:48, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-07-10",
          },
          {
            eventName: "05:21, 木星合月，木星在月球南方 2.23 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-12",
          },
          {
            eventName: "01:48, 天王星合月，天王星在月球南方 2.28 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-13",
          },
          {
            eventName: "02:32, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-07-18",
          },
          {
            eventName: "16:56, 水星合月，水星在月球南方 3.51 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-19",
          },
          {
            eventName: "14:57, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-07-20",
          },
          {
            eventName: "16:37, 金星合月，金星在月球南方 7.86 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-20",
          },
          {
            eventName: "07:29, 金星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-21",
          },
          {
            eventName: "12:00, 火星合月，火星在月球南方 3.27 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-21",
          },
          {
            eventName: "06:07, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-07-26",
          },
          {
            eventName: "21:00, 水星合金星，水星在金星北方 5.29 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-07-26",
          },
          {
            eventName: "02:32, 刻望",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-02",
          },
          {
            eventName: "13:52, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-02",
          },
          {
            eventName: "18:26, 土星合月，土星在月球北方 2.48 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-03",
          },
          {
            eventName: "06:02, 海王星合月，海王星在月球北方 1.48 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-05",
          },
          {
            eventName: "08:03, 木星西方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-07",
          },
          {
            eventName: "17:44, 木星合月，木星在月球南方 2.88 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-08",
          },
          {
            eventName: "18:28, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-08",
          },
          {
            eventName: "09:03, 天王星合月，天王星在月球南方 2.59 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-09",
          },
          {
            eventName: "09:47, 水星東大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-10",
          },
          {
            eventName: "19:15, 金星下合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-13",
          },
          {
            eventName: "01:00, 金星合月，金星在月球南方 13.30 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-16",
          },
          {
            eventName: "10:35, 天王星西方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-16",
          },
          {
            eventName: "17:38, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-16",
          },
          {
            eventName: "19:54, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-16",
          },
          {
            eventName: "19:26, 水星合月，水星在月球南方 6.94 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-18",
          },
          {
            eventName: "07:07, 火星合月，火星在月球南方 2.18 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-19",
          },
          {
            eventName: "12:48, 水星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-23",
          },
          {
            eventName: "17:57, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-24",
          },
          {
            eventName: "16:28, 土星衝",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-27",
          },
          {
            eventName: "11:27, 天王星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-29",
          },
          {
            eventName: "23:54, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-30",
          },
          {
            eventName: "02:08, 土星合月，土星在月球北方 2.49 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-08-31",
          },
          {
            eventName: "09:36, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-08-31",
          },
          {
            eventName: "15:21, 海王星合月，海王星在月球北方 1.38 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-01",
          },
          {
            eventName: "11:34, 金星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-03",
          },
          {
            eventName: "03:47, 木星合月，木星在月球南方 3.31 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-05",
          },
          {
            eventName: "05:02, 木星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-05",
          },
          {
            eventName: "16:45, 天王星合月，天王星在月球南方 2.84 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-05",
          },
          {
            eventName: "19:09, 水星下合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-06",
          },
          {
            eventName: "06:21, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-09-07",
          },
          {
            eventName: "20:59, 金星合月，金星在月球南方 11.39 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-11",
          },
          {
            eventName: "23:43, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-09-12",
          },
          {
            eventName: "01:40, 水星合月，水星在月球南方 6.00 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-14",
          },
          {
            eventName: "08:21, 水星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-15",
          },
          {
            eventName: "09:40, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-09-15",
          },
          {
            eventName: "03:20, 火星合月，火星在月球南方 0.66 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-17",
          },
          {
            eventName: "19:17, 海王星衝",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-19",
          },
          {
            eventName: "21:16, 水星西大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-22",
          },
          {
            eventName: "03:32, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-09-23",
          },
          {
            eventName: "09:29, 土星合月，土星在月球北方 2.65 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-27",
          },
          {
            eventName: "08:59, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-09-28",
          },
          {
            eventName: "00:59, 海王星合月，海王星在月球北方 1.43 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-09-29",
          },
          {
            eventName: "17:57, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-09-29",
          },
          {
            eventName: "11:20, 木星合月，木星在月球南方 3.39 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-02",
          },
          {
            eventName: "01:05, 天王星合月，天王星在月球南方 2.93 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-03",
          },
          {
            eventName: "21:48, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-10-06",
          },
          {
            eventName: "11:42, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-10-10",
          },
          {
            eventName: "17:44, 金星合月，金星在月球南方 6.50 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-10",
          },
          {
            eventName: "17:33, 水星合月，水星在月球北方 0.67 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-14",
          },
          {
            eventName: "01:55, 朔(日環食，國內各地不能看見)",
            calendar: "Other",
            color: "green",
            date: "2023-10-15",
          },
          {
            eventName: "00:17, 火星合月，火星在月球北方 1.00 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-16",
          },
          {
            eventName: "13:38, 水星上合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-20",
          },
          {
            eventName: "11:29, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-10-22",
          },
          {
            eventName: "07:14, 金星西大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-24",
          },
          {
            eventName: "15:56, 土星合月，土星在月球北方 2.78 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-24",
          },
          {
            eventName: "09:23, 海王星合月，海王星在月球北方 1.51 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-26",
          },
          {
            eventName: "11:02, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-10-26",
          },
          {
            eventName: "04:24, 望(月偏食，國內各地可見月沒帶食)",
            calendar: "Other",
            color: "green",
            date: "2023-10-29",
          },
          {
            eventName: "16:14, 木星合月，木星在月球南方 3.14 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-29",
          },
          {
            eventName: "00h, 水星合火星，水星在火星南方 0.36 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-30",
          },
          {
            eventName: "09:53, 天王星合月，天王星在月球南方 2.86 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-10-30",
          },
          {
            eventName: "13:02, 木星衝",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-03",
          },
          {
            eventName: "01:00, 土星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-05",
          },
          {
            eventName: "16:37, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-11-05",
          },
          {
            eventName: "05:49, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-11-07",
          },
          {
            eventName: "17:30, 金星合月，金星在月球南方 1.01 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-09",
          },
          {
            eventName: "17:27, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-11-13",
          },
          {
            eventName: "21:32, 火星合月，火星在月球北方 2.48 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-13",
          },
          {
            eventName: "01:21, 天王星衝",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-14",
          },
          {
            eventName: "22:39, 水星合月，水星在月球北方 1.66 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-14",
          },
          {
            eventName: "13:41, 火星合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-18",
          },
          {
            eventName: "18:50, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-11-20",
          },
          {
            eventName: "22:06, 土星合月，土星在月球北方 2.73 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-20",
          },
          {
            eventName: "05:01, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-11-22",
          },
          {
            eventName: "15:45, 海王星合月，海王星在月球北方 1.47 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-22",
          },
          {
            eventName: "17:47, 土星東方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-23",
          },
          {
            eventName: "19:14, 木星合月，木星在月球南方 2.77 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-25",
          },
          {
            eventName: "17:19, 天王星合月，天王星在月球南方 2.75 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-11-26",
          },
          {
            eventName: "17:16, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-11-27",
          },
          {
            eventName: "22:28, 刻水星東大距",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-04",
          },
          {
            eventName: "02:42, 月球過遠地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-12-05",
          },
          {
            eventName: "13:49, 下弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-12-05",
          },
          {
            eventName: "07:54, 海王星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-07",
          },
          {
            eventName: "00:53, 金星合月，金星在月球北方 3.64 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-10",
          },
          {
            eventName: "18:55, 火星合月，火星在月球北方 3.57 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-12",
          },
          {
            eventName: "07:32, 朔",
            calendar: "Moon",
            color: "orange",
            date: "2023-12-13",
          },
          {
            eventName: "12:55, 水星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-13",
          },
          {
            eventName: "13:19, 水星合月，水星在月球北方 4.36 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-14",
          },
          {
            eventName: "02:53, 月球過近地點",
            calendar: "Moon",
            color: "orange",
            date: "2023-12-17",
          },
          {
            eventName: "11:43, 海王星東方照",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-17",
          },
          {
            eventName: "06:01, 土星合月，土星在月球北方 2.48 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-18",
          },
          {
            eventName: "21:16, 海王星合月，海王星在月球北方 1.26 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-19",
          },
          {
            eventName: "02:39, 上弦",
            calendar: "Moon",
            color: "orange",
            date: "2023-12-20",
          },
          {
            eventName: "22:24, 木星合月，木星在月球南方 2.60 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-22",
          },
          {
            eventName: "02:54, 水星下合日",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-23",
          },
          {
            eventName: "22:54, 天王星合月，天王星在月球南方 2.77 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-23",
          },
          {
            eventName: "08:33, 望",
            calendar: "Moon",
            color: "orange",
            date: "2023-12-27",
          },
          {
            eventName: "11h, 水星合火星，水星在火星南方 3.58 度",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-28",
          },
          {
            eventName: "23:09, 木星留",
            calendar: "Planet",
            color: "blue",
            date: "2023-12-31",
          },
        ];

        function addDate(ev) {}

        var calendar = new Calendar("#calendar", data);
      })();
    </script>
    
     

    
  </body>
</html>
<script>
  

</script>
<script>
  var sunset;
  fetch('日出日沒時刻資料API.json')
  .then(response => response.json())
  .then(data => {
    sunset=data.records.locations.location; 
  })
  .catch(error => console.log('錯誤:', error));

  var moonset;
  fetch('月出月沒時刻資料API.json')
  .then(response => response.json())
  .then(data => {
    moonset=data.records.locations.location; 
  })
  .catch(error => console.log('錯誤:', error));

  
</script>
<script>
      var messageboxT;
      var top1 = 10;
      var opacity = 0;

      // 初始化信息框
      function initMessagebox(info) {
        top1 = 10;
        opacity = 0;
        $("#messagebox").html(info);
        $("#messagebox").css({ display: "block" });
        // 調整色塊大小
        appearMessagebox();
      }

      // 出現信息框
      function appearMessagebox() {
        top1 += 1;
        opacity += 0.05;
        if (opacity < 1) {
          messageboxT = setTimeout(appearMessagebox, 15);
        } else {
          disappearMessagebox();
        }
        // $("#messagebox").css({ top: String(top1) + "px" });
        $("#messagebox").css({ opacity: String(opacity) });
      }

      // 隱藏信息框
      function disappearMessagebox() {
        opacity -= 0.05;
        if (opacity > 0.05) {
          messageboxT = setTimeout(disappearMessagebox, 80);
        } else {
          opacity = 0;
          $("#messagebox").css({ display: "none" });
        }
        $("#messagebox").css({ opacity: String(opacity) });
      }

      // 顯示信息框
      function showMessage(loc_mes) {
        initMessagebox(loc_mes);
      }

      
    </script>
<script>
  const loc_city={"太平山森林遊樂區":"宜蘭縣",
    "小風口停車場":"南投縣",
    "鳶峰停車場":"南投縣",
    "台大梅峰實驗農場":"南投縣",
    "高雄都會公園":"高雄市",
    "新中橫塔塔加停車場":"南投縣",
    "高雄梅山青年活動中心":"高雄市",
    "石碇雲海國小":"新北市",
    "藤枝森林遊樂區":"高雄市",
    "五分山":"新北市",
    "觀霧森林遊樂區":"苗栗縣",
    "墾丁龍磐公園":"屏東縣",
    "烏來風景特定區":"新北市",
    "臺中都會公園":"台中市",
    "大雪山國家森林遊樂區":"台中市",
    "鹿林天文台":"南投縣",
    "南瀛天文教育園區":"台南市",
    "武陵農場":"台中市",
    "臺南都會公園":"台南市",
    "陽明山國家公園小油坑停車場":"台北市",
    "福壽山農場":"台中市",
    "阿里山遊樂區":"嘉義縣",
    "陽明山國家公園擎天崗":"台北市",
    "基隆大武崙砲台停車場":"基隆市",
    "墾丁貓鼻頭":"屏東縣",
    "七股海堤":"台南市"};
  
  const weather_score={"晴時多雲":"95",
    "多雲時晴":"80",
    "晴午後短暫雷陣雨":"90",
    "多雲":"52",
    "多雲午後短暫雷陣雨":"50",
    "陰天":"43",
    "陰時多雲":"40",
    "多雲時陰":"45",
    "多雲短暫陣雨":"35",
    "陰短暫陣雨":"25",
    "多雲時陰短暫陣雨":"23",
    "陰時多雲短暫陣雨":"22",
    "陰時多雲短暫陣雨或雷雨":"20",
    "多雲時陰短暫陣雨或雷雨":"21",
    "多雲短暫陣雨或雷雨":"27",
    "陰短暫陣雨或雷雨":"15"};
  
  const weather_icon={"晴時多雲":"sun",
    "多雲時晴":"cloudysun",
    "晴午後短暫雷陣雨":"cloudysunrain",
    "多雲":"clouds",
    "多雲午後短暫雷陣雨":"cloudyrain",
    "陰天":"cloudy",
    "陰時多雲":"cloudys",
    "多雲時陰":"cloudys",
    "多雲短暫陣雨":"rain",
    "陰短暫陣雨":"cloudyrain",
    "多雲時陰短暫陣雨":"cloudyrain",
    "陰時多雲短暫陣雨":"cloudyrain",
    "陰時多雲短暫陣雨或雷雨":"storm",
    "多雲時陰短暫陣雨或雷雨":"storm",
    "多雲短暫陣雨或雷雨":"storm",
    "陰短暫陣雨或雷雨":"storm"};

  var loc_score_list=[];
  var maxScore = 0;
  var maxScoreLocation = null;
  var recommend_bool=false;
  var loc_mes;
  function loc_recommend(ev){
    maxScore = 0;
    maxScoreLocation = null;
    // document.getElementById("modal").style.display="block";
    recommend_bool=false;
    let eventTime = ev.eventName.split(",")[0];
    loc_score_list=[];
    
    function displayModalAndHighlightLocation(maxScoreLocation, maxScore) {
      if(recommend_bool){
        document.getElementById("modal").style.display = "block";
        document.querySelectorAll(".loc_icon").forEach((element) => {
          element.classList.remove("best");
          if (maxScoreLocation === element.getAttribute("name")) {
            maxScore=parseFloat(maxScore)+0.04;
            document.getElementById(maxScoreLocation).innerHTML=maxScore;
            console.log(maxScoreLocation + " : " + maxScore);
            element.classList.add("best");

            var mapElement = document.getElementById("modal_mask");
            var markerElement = document.getElementById("modal_area");

            var userInputX = parseFloat(element.style.left.split("(")[1].split("px")[0]);
            var userInputY = parseFloat(element.style.top.split("(")[1].split("px")[0]);

            var centerX = mapElement.offsetWidth / 2;
            var centerY = mapElement.offsetHeight / 2;
            var offsetX = centerX - userInputX;
            var offsetY = centerY - userInputY - 27;

            markerElement.style.left = offsetX + "px";
            markerElement.style.top = offsetY + "px";

            var scaleValue = 4;
            mapElement.style.transform = "scale(" + scaleValue + ")";
            document.getElementById("show_weather").style.display = "block";
          }
        });
      }else{
        console.log(loc_mes);
        showMessage("白天無法辨識星象");
      }
      
    }
    setTimeout(() => {
        
        displayModalAndHighlightLocation(maxScoreLocation, maxScore);
          
      }, 500);
    recommend_bool=false;
    document.querySelectorAll(".loc_icon").forEach((element)=>{

      var countyName = loc_city[element.getAttribute("name")];
      var sunTargetData = null;
      var moonTargetData = null;
      for (var i = 0; i < sunset.length; i++) {
        if (sunset[i].CountyName === countyName) {
          sunTargetData = sunset[i];
          moonTargetData = moonset[i];
          break;
        }
      }
      var sunTargetDate = null;
      var moonTargetDate = null;
      for (var i = 0; i < 180; i++) {
        if (sunTargetData.time[i].Date === ev.date._i) {
          sunTargetDate = sunTargetData.time[i];
          moonTargetDate = moonTargetData.time[i];
          break;
        }
      }

      let slp=sun_light_pollution(eventTime,
      sunTargetDate.BeginCivilTwilightTime,
      sunTargetDate.SunRiseTime,
      sunTargetDate.SunSetTime,
      sunTargetDate.EndCivilTwilightTime);

      let mlp=moon_light_pollution(eventTime,
      moonTargetDate.MoonRiseTime,
      moonTargetDate.MoonSetTime);

      var weatherTarget = null;
      for (var i = 0; i < 26; i++) {
        if (weather[i].locationName === element.getAttribute("name")) {
          weatherTarget = weather[i];
          break;
        }
      }
      var max_tems = null ;
      var min_tems = null ;
      var rain_s = null ;
      var wx_s = null;
      for (var i=0 ; i < weatherTarget.weatherElement.length ; i++){
        if (weatherTarget.weatherElement[i].elementName === "MaxT"){
          max_tems = weatherTarget.weatherElement[i];
        }
        if (weatherTarget.weatherElement[i].elementName === "MinT"){
          min_tems = weatherTarget.weatherElement[i];
        }
        if (weatherTarget.weatherElement[i].elementName === "PoP24h"){
          rain_s = weatherTarget.weatherElement[i];
        }
        if (weatherTarget.weatherElement[i].elementName === "Wx"){
          wx_s = weatherTarget.weatherElement[i];
        }
      }
      //console.log(rain_s);
      var max_tem = null ;
      var min_tem = null ;
      var rain = null ;
      var wx = null
      for(var i =0; i<7;i++){
        if(max_tems.time[i].startTime.split("T")[0]==ev.date._i){
          max_tem=max_tems.time[i];
          min_tem=min_tems.time[i];
          rain=rain_s.time[i];
          wx=wx_s.time[i];
          break;
        }
      }
      //console.log(rain);
      let loc_sc=loc_score(slp, mlp, weatherTarget, ev.date._i);
      console.log()
      let final_score=(loc_sc/10).toFixed(2);
      // recommend_bool=false;
      if(isNaN(loc_sc)){
        // recommend_bool=false;
        console.log("NaN");
        loc_mes=loc_sc;
      }else{
        recommend_bool=true;
        console.log(element.getAttribute("name")+" : "+final_score);
        document.getElementById(element.getAttribute("name")).innerHTML=final_score;
        loc_score_list.push([element.getAttribute("name"),final_score]);
        if (final_score > maxScore) {
          maxScore = final_score;
          maxScoreLocation = element.getAttribute("name");
        }
        document.getElementById("loc").textContent = maxScoreLocation;
        document.getElementById("day").textContent = ev.date._i;
        if (rain.elementValue.value != null){
          document.getElementById("rain").textContent = "降雨機率:"+rain.elementValue.value+"%";
        }
        var wi=weather_icon[wx.elementValue[0].value];
        console.log(wi);
        document.getElementById("weather").innerHTML = "<img src=\""+wi+".png\" id=\"weather_icon\"/>";

        document.getElementById("maxmin").textContent = "最高溫:"+max_tem.elementValue.value+"°C / 最低溫:" +min_tem.elementValue.value+"°C";
        document.getElementById("sunRiseTime").textContent = "日出時間:"+sunTargetDate.SunRiseTime+" / 日落時間:"+sunTargetDate.SunSetTime;
        document.getElementById("score").textContent = parseFloat(maxScore)+0.04;
        
        element.addEventListener("click", function() {
          if(element===document.querySelector(".best")){
            document.getElementById("score").textContent = parseFloat(final_score)+0.04;
          }else{
            document.getElementById("score").textContent = final_score;
          }
          var locationName = element.getAttribute("name");
          document.getElementById("loc").textContent = locationName;
          document.getElementById("day").textContent = ev.date._i;
          document.getElementById("maxmin").textContent = "最高溫:"+max_tem.elementValue.value+"°C / 最低溫:" +min_tem.elementValue.value+"°C";
          document.getElementById("sunRiseTime").textContent = "日出時間:"+sunTargetDate.SunRiseTime+" / 日落時間:"+sunTargetDate.SunSetTime;
          // document.getElementById("score").textContent = final_score;
          if (rain.elementValue.value != null){
          document.getElementById("rain").textContent = "降雨機率:"+rain.elementValue.value+"%";
          document.getElementById("weather").innerHTML = "<img src=\""+wi+".png\" id=\"weather_icon\"/>";
          }

        });
        // console.log(recommend_bool);
      }
      console.log(recommend_bool);

      
      
    });
    
    
    
  }

  function sun_light_pollution(EventTime, BeginCivilTwilightTime, SunRiseTime, SunSetTime, EndCivilTwilightTime){

    if(compareTimes(EventTime, SunRiseTime)==1 && compareTimes(EventTime, SunSetTime)==-1){
      return 0;
    }else if(compareTimes(EventTime, SunRiseTime)==-1 && compareTimes(EventTime, BeginCivilTwilightTime)==1){
      return normalizeTime(SunRiseTime, BeginCivilTwilightTime, EventTime).toFixed(2);
    }else if(compareTimes(EventTime, SunSetTime)==1 && compareTimes(EventTime, EndCivilTwilightTime)==-1){
      return normalizeTime(EndCivilTwilightTime, SunSetTime, EventTime).toFixed(2);
    }else{
      return 100;
    }
  }
  function moon_light_pollution(EventTime, MoonRiseTime, MoonSetTime) {
    var moonRise = new Date("1970-01-01 " + MoonRiseTime);
    var moonSet = new Date("1970-01-02 " + MoonSetTime);
    var EventTime = new Date("1970-01-01 " + EventTime);
    var sign=new Date("1970-01-01 12:00");
    if(EventTime < sign){
      EventTime.setDate(EventTime.getDate() + 1);
    }
    if (moonSet < moonRise) {
      moonSet.setDate(moonSet.getDate() + 1);
    }
    if (EventTime < moonRise || EventTime > moonSet) {
      return 10;
    } else if (EventTime >= moonRise && EventTime <= moonSet) {
      var normalizedValue = ((EventTime - moonRise) / (moonSet - moonRise)) * 10;
      return 10-normalizedValue.toFixed(2);
    }
  }

  function loc_score(slp, mlp, weatherTarget, eventDate){
    var timeTarget=null;
    for(var i =0; i<7;i++){
      if(weatherTarget.weatherElement[12].time[i].startTime.split("T")[0]==eventDate){
        timeTarget=weatherTarget.weatherElement[12].time[i];
        break;
      }
    }
    console.log(timeTarget.elementValue[0].value);
    var ws=weather_score[timeTarget.elementValue[0].value];
    
    if(slp==0){
      return "白天無法辨識星象";
    }else if(slp>0 && slp<80){
      return "光害嚴重，可見機率小於5%";
    }else{
      return (parseFloat(ws)*((parseFloat(slp)+parseFloat(mlp))/2))/100;
    }

  }

  function compareTimes(time1, time2) {
    var date1 = new Date("1970-01-01 " + time1);
    var date2 = new Date("1970-01-01 " + time2);
    
    if (date1 < date2) {
      return -1;
    } else if (date1 > date2) {
      return 1;
    } else {
      return 0;
    }
  }

  function normalizeTime(A, B, C) {
    var startTime = new Date("1970-01-01 " + A);
    var endTime = new Date("1970-01-01 " + B);
    var currentTime = new Date("1970-01-01 " + C);

    var totalTime = endTime - startTime;
    var elapsedTime = currentTime - startTime;

    var normalizedValue = (elapsedTime / totalTime) * 100;

    return normalizedValue;
  }

  document.getElementById("exit_modal").addEventListener("click",function(){
    document.getElementById("modal").style.display="none";
  })


  function calculateParameters(proj_coordinates) {
    const point1 = proj_coordinates[0];
    const point2 = proj_coordinates[1];

    const a = (point2.x - point1.x) / (point2.lng - point1.lng);
    const b = point1.x - a * point1.lng;

    const c = (point2.y - point1.y) / (point2.lat - point1.lat);
    const d = point1.y - c * point1.lat;

    return { a, b, c, d };
  }
  x_scale=window.innerWidth * 0.8 / 1000
  y_scale=window.innerWidth * 0.8 / 1000
  const proj_coordinates = [
    { lat: 25.1665, x: 894 * x_scale, lng: 121.6059, y: 358 * y_scale },
    { lat: 24.5868, x: 669.9 * x_scale, lng: 120.7534, y: 526.1 * y_scale },
    { lat: 22.8628, x: 569.7 * x_scale, lng: 120.3725, y: 1021.4 * y_scale },
  ];

  const { a, b, c, d } = calculateParameters(proj_coordinates);
  
  
  
  function add_loc_icon(lat, lon, name){

    const svgX = a * lon + b;
    const svgY = c * lat + d;

    const iconElement = document.createElement('i');
    iconElement.className = 'fa-solid fa-location-dot loc_icon';
    iconElement.setAttribute("name",name);
    iconElement.style.left = `calc(${svgX}px - 4.5px + ${window.innerWidth*0.05}px)`;
    iconElement.style.top = `calc(${svgY}px - 13px + ${window.innerHeight*0.2}px)`;

    const pElement = document.createElement('p');
    pElement.innerHTML = '';
    pElement.className = 'loc_label';
    pElement.setAttribute("id",name);
    pElement.style.left = `calc(${svgX}px - 12px + ${window.innerWidth*0.05}px)`;
    pElement.style.top = `calc(${svgY}px - 9px + ${window.innerHeight*0.2}px)`;

    const container = document.getElementById('modal_area');
    container.appendChild(iconElement);
    container.appendChild(pElement);
  }
  
  var weather;
  var we;
  fetch('育樂天氣預報資料.json')
  .then(response => response.json())
  .then(data => {
    we=data;
    weather=data.cwbopendata.dataset.locations.location;
    console.log(we)
    weather.forEach((element) => {
      add_loc_icon(element.lat, element.lon, element.locationName);
    })
  })
  .catch(error => console.log('錯誤:', error));

  var show_data
  var show_temper
  fetch('七天天氣預報.json')
  .then(response => response.json())
  .then(data => {
    show_data=data;
    show_temper = data.cwbopendata.dataset.location;
  })
  .catch(error => console.log('錯誤:', error));
</script>
<script>
  var slideObject=document.getElementById("modal_area");
  var touchStartX = 0;
  var touchStartY = 0;
  var initialTop = 0;
  var initialLeft = 0;

  slideObject.addEventListener("touchstart", function (event) {
    touchStartX = event.touches[0].clientX;
    touchStartY = event.touches[0].clientY;
    initialTop = parseInt(window.getComputedStyle(slideObject).top);
    initialLeft = parseInt(window.getComputedStyle(slideObject).left);
  });

  slideObject.addEventListener("touchmove", function (event) {
    event.preventDefault();

    var touchMoveX = event.touches[0].clientX;
    var touchMoveY = event.touches[0].clientY;
    var deltaX = touchMoveX - touchStartX;
    var deltaY = touchMoveY - touchStartY;

   
    var newTop = initialTop + deltaY/3;
    var newLeft = initialLeft + deltaX/3;

    
    newTop = Math.min(120, Math.max(-235, newTop));
    newLeft = Math.min(40, Math.max(-140, newLeft));

    slideObject.style.top = newTop + "px";
    slideObject.style.left = newLeft + "px";
  });

  slideObject.addEventListener("touchend", function (event) {
   
    touchStartX = 0;
    touchStartY = 0;
    initialTop = 0;
    initialLeft = 0;
  });
</script>
<script>
  
</script>


