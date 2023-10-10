'use strict';

// //スクロール時にナビバーの透過度を変更する
// window.addEventListener('scroll',function(){

//   let opacity = 1 - (window.scrollY / 500); // 500はフェードアウトの速度を調整する値です。この値を変更して効果の速度を調整することができます。
  
//   // 透明度が0未満や1を超えないようにする
//   if (opacity < 0) opacity = 0;
//   if (opacity > 1) opacity = 1;

//   document.getElementById("scrollchange").style.backgroungColor = "rgba(255,255,255,"+ "0.5" + ";";

// });

//再生数、フォロワー数、投稿数のオブジェクト
let profile = {
  targetnumofviews:0,
  targetnumoffollowers:0,
  targetnumofposts:0
};

//Youtube情報
let Youtube = {
  Youtubenumofviews:0,
  Youtubenumoffollowers:0,
  Youtubenumofposts:0
}

//Instagram情報（2023/10/6時点）
//他人のIDが分からない為、APIを使用するのをやめた
let Instagram = {
  Instagramnumofviews:94945000,
  Instagramnumoffollowers:110000,
  Instagramnumofposts:192
}

//Tiktok情報
//公式APIが公開されていないので手動（2023/10/6時点）
let Tiktok = {
  Tiktoknumofviews:31800500,
  Tiktoknumoffollowers:30000,
  Tiktoknumofposts:152
}

/*
//Instagram情報を取得する
const instaBusinessId = '107637648737920';
const accessToken = 'EAAUVXwLXwi0BO6eaSUCPFZC2PZABFmkKtZBobNQRgHVk8yrmAWMeP4M14AuwR4TLGfohF40X9ubgySPU3tVDH69fAeGWAXziTxxXi794E3jGkGfOu0AZBIxo1tsJGSEAtzBnhF841m0ZAqjSWXcOkMSOWbvZAoJWh0nBY3AzH0yovkbXIGvZBSDRFJhTmJxvwE4Fa3pEd5XNaC9G64ZD';

const instaAccountName = 'bluebottle'; // 対象のInstagramユーザーID


// ビジネスディスカバリーAPIを叩く関数
function businessDiscoveryApi() {

 const url = `https://graph.facebook.com/v17.0/${instaBusinessId}?fields=business_discovery.username(${instaAccountName}){followers_count,media_count}&access_token=${accessToken}`;
 const response = instagramApi(url,'GET','');
 try {
  if (response) {
   const data = JSON.parse(response.getContentText());
   console.log(data); //返り値①
   console.log(data.business_discovery.media.data); //返り値②
  return data;
  } else {
  console.error('Instagram APIのリクエストでエラーが発生しました。');
  return null;
  }
 } catch (error) {
  console.error('Instagram APIのレスポンスの解析中にエラーが発生しました:', error);
  return null;
 }
}

// APIを叩く関数
function instagramApi(url, method, payload) {
 try {
  const headers = {
  'Authorization': 'Bearer ' + accessToken
 };
 const options = {
  'method': method,
  'headers': headers,
  'payload': payload
 };
 console.log('url',url)
 const response = UrlFetchApp.fetch(url, options);
 return response;
 } catch (error) {
  console.error('Instagram APIのリクエスト中にエラーが発生しました:', error);
  return null;
 }
}
*/

//Youtube情報を取得する
const apiKey = 'AIzaSyBE4PeVkuJZ3W-a-SmirH5d5U9H0kKryS0'; // 上記で取得したAPIキーをここに入力
const channelId = 'UCWGRengKX-moCv-g2JLVI6w'; // 対象のYouTubeチャンネルのIDをここに入力

const url = `https://www.googleapis.com/youtube/v3/channels?part=statistics&id=${channelId}&key=${apiKey}`;

fetch(url)
  .then(response => response.json())
  .then(data => {
    Youtube.Youtubenumofviews = parseInt(data.items[0].statistics.viewCount, 10);
    Youtube.Youtubenumoffollowers = parseInt(data.items[0].statistics.subscriberCount, 10);
    Youtube.Youtubenumofposts = parseInt(data.items[0].statistics.videoCount, 10);

    startCountUpAnimationsnumofviews();
    startCountUpAnimationsnumoffollowers();
    startCountUpAnimationsnumofposts();
  })
  .catch(error => console.error('エラー:', error));

//各SNSのパラメータを加算する関数を用意
function calc(A, B, C){
  return A + B + C;
}

// 総再生数アニメーションを開始する関数
function startCountUpAnimationsnumofviews() {
  profile.targetnumofviews = calc(Youtube.Youtubenumofviews, Instagram.Instagramnumofviews, Tiktok.Tiktoknumofviews);
  //総再生数カウントアップ用
  $('#box1').on('inview', function(event, isInView) {
    if (isInView) {
      //要素が見えたときに実行する処理
      $("#box1 .count-up1").each(function(){
        const currentValue = 0;
        const counterValue = Math.max(profile.targetnumofviews, currentValue);

        $(this).prop('Counter',0).animate({//0からカウントアップ
              Counter: counterValue
              
          }, {
          // スピードやアニメーションの設定
              duration: 2000,//数字が大きいほど変化のスピードが遅くなる。2000=2秒
              easing: 'swing',//動きの種類。他にもlinearなど設定可能
              step: function (now) {
                  $(this).text(Math.ceil(now));
              },
              complete: function() {
                // アニメーションが完了した後、最大値でHTMLを書き換える
                if (counterValue === profile.targetnumofviews) {
                  $(this).text(profile.targetnumofviews.toLocaleString());
                }
              }
          });
      });
    }
  });
}

// 総フォロワー数アニメーションを開始する関数
function startCountUpAnimationsnumoffollowers() {
  profile.targetnumoffollowers = calc(Youtube.Youtubenumoffollowers, Instagram.Instagramnumoffollowers, Tiktok.Tiktoknumoffollowers);

  //総フォロワー数カウントアップ用
  $('#box2').on('inview', function(event, isInView) {
    if (isInView) {
      //要素が見えたときに実行する処理
      $("#box2 .count-up2").each(function(){
        const currentValue = 0;
        const counterValue = Math.max(profile.targetnumoffollowers, currentValue);

        $(this).prop('Counter',0).animate({//0からカウントアップ
              Counter: counterValue
              
          }, {
          // スピードやアニメーションの設定
              duration: 2000,//数字が大きいほど変化のスピードが遅くなる。2000=2秒
              easing: 'swing',//動きの種類。他にもlinearなど設定可能
              step: function (now) {
                  $(this).text(Math.ceil(now));
              },
              complete: function() {
                // アニメーションが完了した後、最大値でHTMLを書き換える
                if (counterValue === profile.targetnumoffollowers) {
                  $(this).text(profile.targetnumoffollowers.toLocaleString());
                }
              }
          });
      });
    }
  });
}

// 投稿数アニメーションを開始する関数
function startCountUpAnimationsnumofposts() {
  profile.targetnumofposts = calc(Youtube.Youtubenumofposts, Instagram.Instagramnumofposts, Tiktok.Tiktoknumofposts);

  //投稿数カウントアップ用
  $('#box3').on('inview', function(event, isInView) {
    if (isInView) {
      //要素が見えたときに実行する処理
      $("#box3 .count-up3").each(function(){
        const currentValue = 0;
        const counterValue = Math.max(profile.targetnumofposts, currentValue);

        $(this).prop('Counter',0).animate({//0からカウントアップ
              Counter: counterValue
              
          }, {
          // スピードやアニメーションの設定
              duration: 2000,//数字が大きいほど変化のスピードが遅くなる。2000=2秒
              easing: 'swing',//動きの種類。他にもlinearなど設定可能
              step: function (now) {
                  $(this).text(Math.ceil(now));
              },
              complete: function() {
                // アニメーションが完了した後、最大値でHTMLを書き換える
                if (counterValue === profile.targetnumofposts) {
                  $(this).text(profile.targetnumofposts.toLocaleString());
                }
              }
          });
      });
    }
  });
}

// // 動画オブジェクトの格納用
// var players = {};

// // YouTube APIが準備できたら実行される関数
// function onYouTubeIframeAPIReady() {
//     players.player1 = new YT.Player('player1');
//     players.player2 = new YT.Player('player2');

//     // 各iframeにマウスオーバーイベントを追加
//     document.getElementById('player1').addEventListener('mouseover', function() {
//         players.player1.playVideo();
//     });
//     document.getElementById('player1').addEventListener('mouseout', function() {
//         players.player1.pauseVideo();
//     });

//     document.getElementById('player2').addEventListener('mouseover', function() {
//         players.player2.playVideo();
//     });
//     document.getElementById('player2').addEventListener('mouseout', function() {
//         players.player2.pauseVideo();
//     });
// }