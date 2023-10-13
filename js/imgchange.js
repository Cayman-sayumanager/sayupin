(function($) {
  $.fn.imgchange = function(options) {

      var elements = this;
      var defaults = {
          breakArr: [768, 980],
          dataName: 'imgsrc',
          delay: 200
      };
      var setting = $.extend(defaults, options);

      var currentNo; // 現在表示中の画像
      var latestNo; // 前回表示した画像

      imageChange();
      $(window).on('resize', function() {
          setTimeout(function() {
              imageChange();
          }, setting.delay);
      });

      // 画像変更の処理をする関数
      function imageChange() {
          // 現在表示する画像を調べる
          for (var i = 0; i < setting.breakArr.length; i++) {
              if(window.matchMedia('(max-width: ' + setting.breakArr[i] + 'px)').matches) {
                  currentNo = i;
                  break;
              }
              if(i >= setting.breakArr.length - 1) {
                  currentNo = i + 1;
              }
          }

          // 前回の変更から変わっている場合のみ
          if(currentNo !== latestNo) {
              for (var i = 0; i < elements.length; i++) {
                  var srcArr = elements.eq(i).data(setting.dataName);
                  elements.eq(i).attr('src', srcArr[currentNo]);
              }
              latestNo = currentNo;
          }
      }
  }
})(jQuery);

$(function() {
  $('.sp_tb_pc').imgchange();
  $('.sp_pc').imgchange({
      breakArr: [640]
  });
  $('.sp_tb_pc_wide').imgchange({
      breakArr: [768, 980, 1200]
  });
});