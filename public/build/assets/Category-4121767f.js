import{P as p}from"./ProductCard-812714c2.js";import{U as m}from"./UserLayout-774ee41c.js";import{_ as u,r as s,o,c as e,a,b as r,t as c,F as n,h as _}from"./app-e00fb960.js";import"./dialog-ed01fe28.js";import"./use-outside-click-2a9cf22d.js";import"./MagnifyingGlassIcon-d05987a5.js";import"./XMarkIcon-d2224846.js";import"./CheckCircleIcon-b5e872bb.js";const g={components:{ProductCard:p},props:{products:Object,category:Object},layout:m},f={class:"px-4 xl:px-16 py-10"},x={class:"text-xl font-bold mb-6"},y={class:"grid grid-cols-2 xl:grid-cols-4 gap-4"};function h(b,v,t,C,P,B){const d=s("Head"),l=s("ProductCard");return o(),e(n,null,[a(d,{title:t.category.name},null,8,["title"]),r("div",f,[r("div",x,c(t.category.name)+" ("+c(t.products.length)+") ",1),r("div",y,[(o(!0),e(n,null,_(t.products,i=>(o(),e("div",null,[a(l,{product:i},null,8,["product"])]))),256))])])],64)}const V=u(g,[["render",h]]);export{V as default};