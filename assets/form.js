!function o(n,i,u){function c(r,e){if(!i[r]){if(!n[r]){var t="function"==typeof require&&require;if(!e&&t)return t(r,!0);if(l)return l(r,!0);var s=new Error("Cannot find module '"+r+"'");throw s.code="MODULE_NOT_FOUND",s}var a=i[r]={exports:{}};n[r][0].call(a.exports,function(e){return c(n[r][1][e]||e)},a,a.exports,o,n,i,u)}return i[r].exports}for(var l="function"==typeof require&&require,e=0;e<u.length;e++)c(u[e]);return c}({1:[function(e,r,t){"use strict";function o(){document.querySelectorAll(".field-msg").forEach(function(e){return e.classList.remove("show")})}document.addEventListener("DOMContentLoaded",function(e){var a=document.getElementById("loki-testimonial-form");a.addEventListener("submit",function(e){e.preventDefault(),o();var r={name:a.querySelector('[name="name"]').value,email:a.querySelector('[name="email"]').value,message:a.querySelector('[name="message"]').value,nonce:a.querySelector('[name="nonce"]').value};if(r.name)if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(r.email).toLowerCase()))if(r.message){var t=a.dataset.url,s=new URLSearchParams(new FormData(a));a.querySelector(".js-form-submission").classList.add("show"),fetch(t,{method:"POST",body:s}).then(function(e){return e.json()}).catch(function(e){o(),a.querySelector(".js-form-error").classList.add("show")}).then(function(e){o(),0!==e&&"error"!==e.status?(a.querySelector(".js-form-success").classList.add("show"),a.reset()):a.querySelector(".js-form-error").classList.add("show")})}else a.querySelector('[data-error="invalidMessage"]').classList.add("show");else a.querySelector('[data-error="invalidEmail"]').classList.add("show");else a.querySelector('[data-error="invalidName"]').classList.add("show")})})},{}]},{},[1]);
//# sourceMappingURL=form.js.map
