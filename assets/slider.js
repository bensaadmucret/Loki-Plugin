!function n(o,s,u){function l(r,e){if(!s[r]){if(!o[r]){var t="function"==typeof require&&require;if(!e&&t)return t(r,!0);if(d)return d(r,!0);var i=new Error("Cannot find module '"+r+"'");throw i.code="MODULE_NOT_FOUND",i}var c=s[r]={exports:{}};o[r][0].call(c.exports,function(e){return l(o[r][1][e]||e)},c,c.exports,n,o,s,u)}return s[r].exports}for(var d="function"==typeof require&&require,e=0;e<u.length;e++)l(u[e]);return l}({1:[function(e,r,t){"use strict";var n=document.querySelector(".ac-slider--view > ul"),o=document.querySelectorAll(".ac-slider--view__slides"),i=document.querySelector(".ac-slider--arrows__left"),c=document.querySelector(".ac-slider--arrows__right"),s=o.length,u=function(e){var r,t=document.querySelector(".ac-slider--view__slides.is-active"),i=Array.from(o).indexOf(t)+e+e,c=document.querySelector(".ac-slider--view__slides:nth-child(".concat(i,")"));s<i&&(c=document.querySelector(".ac-slider--view__slides:nth-child(1)")),0==i&&(c=document.querySelector(".ac-slider--view__slides:nth-child(".concat(s,")"))),r=c,t.classList.remove("is-active"),r.classList.add("is-active"),n.setAttribute("style","transform:translateX(-"+r.offsetLeft+"px)")};c.addEventListener("click",function(){return u(1)}),i.addEventListener("click",function(){return u(0)})},{}]},{},[1]);
//# sourceMappingURL=slider.js.map
