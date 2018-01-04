<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>阿里西西 js.alixixi.com DEMO 商品属性选择器</title>
<style type="text/css">
:focus{ outline:none; }
*{ font:12px/1.5em arial; }
html{ background-color:#F0F0F0; }
ul, dd{ margin:0px; padding:0px; }
li{ list-style:none; list-style-type:none; }
a{ color:#333; text-decoration:none; }
a:hover{ color:#F00; text-decoration:none; }
div{ clear:both; }
h2{ font-weight:bold; }
.box{ overflow:hidden; }
.box li{ display:inline; margin:0 4px; }
.box li a{ display:inline-block; border:1px solid #CCC; padding:0 4px; vertical-align:middle; background-color:#FFF; }
.box .title a{ color:#F60; border-color:#F60; background-color:#FF9; }
.box .con a{ color:#999; border-color:#999; }
</style>
</head>
<body>
<div class="box">
 <div id="selected" class="title"><h2>请选择：</h2></div>
 <div class="con">
  <h2>尺寸：</h2>
  <ul id="size">
   <li><a href="#S">S (小号)</a></li>
   <li><a href="#M">M (中号)</a></li>
   <li><a href="#L">L (大号)</a></li>
   <li><a href="#XL">XL (加大号)</a></li>
   <li><a href="#XXL">XXL (加加大号)</a></li>
  </ul>
 </div>
 <div class="con">
  <h2>颜色：</h2>
  <ul id="color">
   <li><a href="#white">白色</a></li>
   <li><a href="#black">黑色</a></li>
   <li><a href="#red">红色</a></li>
   <li><a href="#yellow">黄色</a></li>
   <li><a href="#orange">橙色</a></li>
   <li><a href="#blue">蓝色</a></li>
  </ul>
 </div>
 <div class="con">
  <h2>价格：</h2>
  <ul id="price">
    <li><a href="#50">50</a></li>
   <li><a href="#50-100">51-100</a></li>
   <li><a href="#101-200">101-200</a></li>
   <li><a href="#201-300">201-300</a></li>
   <li><a href="#301-400">301-400</a></li>
   <li><a href="#401">400以上</a></li>
  </ul>
 </div>
</div>
<script type="text/javascript">
(function(){
 //选择器
 var selected = document.getElementById('selected');
 //尺寸
 var size = document.getElementById('size');
 var sizeLink = size.getElementsByTagName('A');
 for(var i=0;i<sizeLink.length;i++){
  sizeLink.item(i).onclick = function(){
   var attr = this.getAttribute('name');
   if(!attr||attr==null){
    this.setAttribute('name','size');
    selected.appendChild(this.parentNode);
   }else{
    this.removeAttribute('name');
    size.appendChild(this.parentNode);
   }
  }
 }
 //颜色
 var color = document.getElementById('color');
 var colorLink = color.getElementsByTagName('A');
 for(var i=0;i<colorLink.length;i++){
  colorLink.item(i).onclick = function(){
   var attr = this.getAttribute('name');
   if(!attr||attr==null){
    this.setAttribute('name','color');
    selected.appendChild(this.parentNode);
   }else{
    this.removeAttribute('name');
    color.appendChild(this.parentNode);
   }
  }
 }
 //价格
 var price = document.getElementById('price');
 var priceLink = price.getElementsByTagName('A');
 for(var i=0;i<priceLink.length;i++){
  priceLink.item(i).onclick = function(){
   var attr = this.getAttribute('name');
   if(!attr||attr==null){
    this.setAttribute('name','price');
    selected.appendChild(this.parentNode);
   }else{
    this.removeAttribute('name');
    price.appendChild(this.parentNode);
   }
  }
 }
})();
</script>
</body>
</html>