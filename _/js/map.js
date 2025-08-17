// JavaScript Document

//<![CDATA[
function load() {
if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map"));

//座標と地図倍率を設定
map.setCenter(new GLatLng(34.671951,133.740794), 16);

//マップ切り替えボタンを設置
map.addControl(new GMapTypeControl());

//詳細なコントロールボタンを設置
map.addControl(new GLargeMapControl());

//マウスホイールで拡大・縮小を行う
map.enableScrollWheelZoom();

//縮小マップを設置
map.addControl(new GOverviewMapControl());


//吹き出しを付ける
var marker1 = new GMarker(new GLatLng(34.671951,133.740794));
map.addOverlay(marker1);

//吹き出しにリンクを貼る
GEvent.addListener(marker1, "click", function()
{marker1.openInfoWindowHtml("個別指導レビュー<br>〒719-1136 岡山県総社市駅前2-2-10新世紀観光ビル2F<br>tel.0866-95-2100");});
　　}
}
//]]>
