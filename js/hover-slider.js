/**
 * @package 	WordPress
 * @subpackage 	Startup Company
 * @version		1.0.3
 */


/*!
 * Hover Slider Script
 */
(function(e){"use strict";e.fn.cmsmastersHoverSlider=function(t){var n={sliderBlock:".cmsmasters_hover_slider",sliderItems:".cmsmasters_hover_slider_items",thumbWidth:"60",thumbHeight:"40",activeSlide:1,pauseTime:5e3,pauseOnHover:true},r=this,s,o={};o={init:function(){o.options=e.extend({},n,t);o.el=r;o.vars={};if(o.options.pauseTime!==0){o.vars.countdown=Math.round(o.options.pauseTime/50)}else{o.vars.countdown=-1}o.setVars();o.startSlider()},setVars:function(){o.vars.sliderBlock=e(o.options.sliderBlock);o.vars.items_thumbWidth=o.options.thumbWidth;o.vars.items_thumbHeight=o.options.thumbHeight;o.vars.activeSlide=o.options.activeSlide-1;o.vars.pauseTime=o.options.pauseTime;o.vars.thumbsHTML="";o.vars.inPause=false;o.vars.list=o.el.find(o.options.sliderItems);o.vars.items=o.vars.list.find("> li");o.vars.items_img=o.vars.items.find("img");o.vars.items_img_count=o.vars.items.length;if(o.options.activeSlide>o.vars.items_img_count){o.vars.activeSlide=0}},startSlider:function(){o.vars.sliderBlock.append('<ul class="cmsmasters_hover_slider_thumbs"></ul>');for(var i=0;i<o.vars.items_img_count;i+=1){o.vars.thumbsHTML+="<li>"+'<a href="#" class="cmsmasters_hover_slider_thumb">'+'<img src="'+o.vars.items_img.eq(i).attr("src")+'" alt="" width="'+o.vars.items_thumbWidth+'" height="'+o.vars.items_thumbHeight+'" />'+"</a>"+"</li>"}o.vars.sliderBlock.find(".cmsmasters_hover_slider_thumbs").append(o.vars.thumbsHTML);o.vars.items.eq(o.vars.activeSlide).css({visibility:"visible",opacity:1}).addClass("hovered_slide");o.vars.sliderBlock.find(".cmsmasters_hover_slider_thumbs > li").eq(o.vars.activeSlide).addClass("hovered_item");o.vars.activeSlide+=1;o.attachEvents()},nextSlide:function(e){o.setTimer();o.vars.items.filter(".hovered_slide").css({visibility:"hidden",opacity:0}).removeClass("hovered_slide");o.vars.sliderBlock.find(".cmsmasters_hover_slider_thumbs > li").filter(".hovered_item").removeClass("hovered_item");o.vars.items.eq(e).css({visibility:"visible",opacity:1}).addClass("hovered_slide");o.vars.sliderBlock.find(".cmsmasters_hover_slider_thumbs > li").eq(e).addClass("hovered_item");o.vars.activeSlide=e+1;if(o.vars.activeSlide===o.vars.items_img_count){o.vars.activeSlide=0}},attachEvents:function(){s=setInterval(function(){o.timerController()},50);e(".cmsmasters_hover_slider_thumb").bind("mouseover",function(){var t=o.vars.items.filter(".hovered_slide").index(),n=e(this).parents("li").index();if(t!==n){o.nextSlide(n)}});e(".cmsmasters_hover_slider_thumb").bind("click",function(){return false});if(o.options.pauseOnHover){o.vars.sliderBlock.bind("mouseover",function(){o.vars.inPause=true}).bind("mouseout",function(){o.vars.inPause=false})}},setTimer:function(){o.vars.inPause=false;if(o.options.pauseTime!==0){o.vars.countdown=Math.round(o.options.pauseTime/50)}else{o.vars.countdown=-1}},timerController:function(){if(o.vars.inPause||o.vars.countdown<0){return}if(o.vars.countdown===0){o.nextSlide(o.vars.activeSlide)}o.vars.countdown-=1}};o.init()}})(jQuery);

