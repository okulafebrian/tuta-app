import{_ as n,r as a,o,d as h,w as d,b as s,t,c as _,e as r}from"./app-a798eb3e.js";const l={props:{category:Object,shoe:Object}},m={class:"mb-4"},u=["src"],f={class:"text-center"},g={class:"line-clamp-2"},b={class:"flex justify-center items-baseline gap-3"},k={class:"font-semibold"},v={key:0,class:"text-gray-400 line-through"};function x(c,y,e,S,B,C){const i=a("Link");return o(),h(i,{href:c.route("shop.shoe",[e.category,e.shoe]),class:"block"},{default:d(()=>[s("div",m,[s("img",{src:"/storage/shoes/"+e.shoe.code+"/"+e.shoe.photo+"/"+e.shoe.mainPhoto},null,8,u)]),s("div",f,[s("div",g,t(e.shoe.name),1),s("div",b,[s("div",k," Rp"+t((e.shoe.is_discount?e.shoe.discount_price:e.shoe.price).toLocaleString("id-ID")),1),e.shoe.is_discount?(o(),_("div",v," Rp"+t(e.shoe.price.toLocaleString("id-ID")),1)):r("",!0)])])]),_:1},8,["href"])}const j=n(l,[["render",x]]);export{j as S};
