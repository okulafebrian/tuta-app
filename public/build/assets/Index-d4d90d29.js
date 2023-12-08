import{U as I}from"./UserLayout-acce20e2.js";import{_ as b,T as j,r,o as n,c as i,b as t,a as l,n as v,t as s,F as w,f as $,w as f,j as x}from"./app-a798eb3e.js";import{r as L,a as q}from"./PlusIcon-1da50b7c.js";import{r as B}from"./TrashIcon-124f03de.js";import"./transition-6367855b.js";import"./focus-management-2fce0f0b.js";import"./micro-task-84f21bb7.js";import"./use-outside-click-e3d89dfb.js";import"./CheckCircleIcon-b26d9947.js";const V={components:{MinusIcon:L,PlusIcon:q},props:{modelValue:Number,max:Number,id:Number},watch:{"form.quantity"(){this.form.put(route("carts.update",this.id),{preserveScroll:!0}),this.$emit("update:modelValue",this.form.quantity)}},methods:{decrement(){this.form.quantity>1&&this.form.quantity--},increment(){this.form.quantity<this.max&&this.form.quantity++}},setup(o){return{form:j({quantity:o.modelValue})}}},M={class:"flex items-center bg-slate-100 rounded-lg"},N={class:"text-center font-medium w-10"};function S(o,c,a,u,g,d){const _=r("MinusIcon"),h=r("PlusIcon");return n(),i("div",M,[t("button",{onClick:c[0]||(c[0]=(...m)=>d.decrement&&d.decrement(...m)),type:"button",class:v(["p-3",u.form.quantity===1?"text-slate-400 cursor-not-allowed":"text-lime-600"])},[l(_,{class:"w-4 h-4",style:{"stroke-width":"3"}})],2),t("div",N,s(u.form.quantity),1),t("button",{onClick:c[1]||(c[1]=(...m)=>d.increment&&d.increment(...m)),type:"button",class:v(["p-3",u.form.quantity===a.max?"text-slate-400 cursor-not-allowed":"text-lime-600"])},[l(h,{class:"w-4 h-4",style:{"stroke-width":"3"}})],2)])}const P=b(V,[["render",S]]),T={setup(){return{}}},D={class:"stroke-lime-600",width:"400px",height:"800px",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},R=t("path",{d:"M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z","stroke-width":"1.5"},null,-1),H=t("path",{d:"M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z","stroke-width":"1.5"},null,-1),z=t("path",{d:"M11.5 12.5L14.5 9.5M14.5 12.5L11.5 9.5","stroke-width":"1.5","stroke-linecap":"round"},null,-1),K=t("path",{d:"M2 3L2.26121 3.09184C3.5628 3.54945 4.2136 3.77826 4.58584 4.32298C4.95808 4.86771 4.95808 5.59126 4.95808 7.03836V9.76C4.95808 12.7016 5.02132 13.6723 5.88772 14.5862C6.75412 15.5 8.14857 15.5 10.9375 15.5H12M16.2404 15.5C17.8014 15.5 18.5819 15.5 19.1336 15.0504C19.6853 14.6008 19.8429 13.8364 20.158 12.3075L20.6578 9.88275C21.0049 8.14369 21.1784 7.27417 20.7345 6.69708C20.2906 6.12 18.7738 6.12 17.0888 6.12H11.0235M4.95808 6.12H7","stroke-width":"1.5","stroke-linecap":"round"},null,-1),U=[R,H,z,K];function O(o,c,a,u,g,d){return n(),i("svg",D,U)}const F=b(T,[["render",O]]),Z={data(){return{createIsOpen:!0}},props:{carts:Object,totalPrice:Number,provinces:Object},components:{NumberInput:P,TrashIcon:B,Cart:F},methods:{removeCart(o){this.$inertia.delete(route("carts.destroy",o))}},layout:I},E={class:"px-4 lg:px-20 pt-10 pb-24"},Y={key:0},A=t("div",{class:"text-3xl font-semibold mb-10"},"Keranjang",-1),G={class:"flex flex-col xl:flex-row gap-16"},J={class:"flex-1 space-y-5"},Q=["src"],W={class:"flex-1 flex flex-col xl:flex-row justify-between gap-3 xl:gap-6"},X={class:"space-y-1"},tt={class:"font-semibold"},et={class:"text-sm text-zinc-600"},st={class:"text-sm"},ot={key:0,class:"space-x-2"},nt={class:"font-normal text-zinc-400 line-through"},it={key:1},lt={class:"flex items-end h-full"},at={class:"flex items-center gap-6"},ct=["onClick"],dt={class:"hidden xl:block w-1/3"},rt={class:"border rounded-xl p-6"},ut=t("div",{class:"text-lg font-semibold"},"Ringkasan Belanja",-1),mt={class:"space-y-2 text-gray-600 my-4"},_t={class:"flex justify-between"},ht=t("div",null,"Total Harga",-1),pt={class:"border-t py-4 mb-4 flex justify-between text-lg font-semibold"},ft=t("div",null,"Total Belanja",-1),xt={class:"xl:hidden fixed left-0 right-0 bottom-0 p-4 flex items-center justify-between border-t bg-white"},vt=t("div",{class:"text-sm"},"Total Belanja",-1),bt={class:"font-semibold"},gt={key:1,class:"text-center py-10"},yt={class:"flex justify-center mb-6"},wt={class:"bg-lime-100 rounded-full p-6"},kt=t("div",{class:"mb-8"},[t("div",{class:"text-2xl font-semibold mb-2"},"Keranjang Belanjamu Kosong"),t("div",{class:"text-zinc-500"},"Yuk, cari sepatu wanita favoritmu di sini")],-1);function Ct(o,c,a,u,g,d){const _=r("Head"),h=r("TrashIcon"),m=r("NumberInput"),p=r("Link"),k=r("Cart");return n(),i(w,null,[l(_,{title:"Keranjang"}),t("div",E,[a.carts.length>0?(n(),i("div",Y,[A,t("div",G,[t("div",J,[(n(!0),i(w,null,$(a.carts,(e,C)=>(n(),i("div",{class:v(["flex gap-6 h-fit",{"border-t pt-5":C>0}])},[t("div",null,[t("img",{src:"/storage/shoes/"+e.code+"/"+e.variantPhoto,class:"w-28 ring-1 ring-gray-200 rounded-lg p-2"},null,8,Q)]),t("div",W,[t("div",X,[t("div",tt,s(e.name),1),t("div",et,s(e.color)+", "+s(e.size),1),t("div",st,[e.is_discount?(n(),i("div",ot,[t("span",null,"Rp"+s(e.discount_price.toLocaleString("id-ID")),1),t("span",nt," Rp"+s(e.price.toLocaleString("id-ID")),1)])):(n(),i("div",it,"Rp"+s(e.price.toLocaleString("id-ID")),1))])]),t("div",lt,[t("div",at,[t("button",{type:"button",onClick:y=>d.removeCart(e.id),class:"block"},[l(h,{class:"w-6 h-6 text-slate-400 stroke-2"})],8,ct),t("div",null,[l(m,{modelValue:e.quantity,"onUpdate:modelValue":y=>e.quantity=y,id:e.id,max:e.stock},null,8,["modelValue","onUpdate:modelValue","id","max"])])])])])],2))),256))]),t("div",dt,[t("section",rt,[ut,t("div",mt,[t("div",_t,[ht,t("div",null,"Rp "+s(a.totalPrice.toLocaleString("id-ID")),1)])]),t("div",pt,[ft,t("div",null,"Rp "+s(a.totalPrice.toLocaleString("id-ID")),1)]),l(p,{href:o.route("checkout"),class:"block bg-lime-600 hover:bg-lime-700 py-3 w-full rounded-full font-medium text-white text-center xl:text-lg"},{default:f(()=>[x(" Beli ")]),_:1},8,["href"])])]),t("div",xt,[t("div",null,[vt,t("div",bt,"Rp "+s(a.totalPrice.toLocaleString("id-ID")),1)]),l(p,{href:o.route("checkout"),class:"block bg-lime-600 hover:bg-lime-700 px-12 py-2.5 rounded-lg font-medium text-white text-center"},{default:f(()=>[x(" Beli ")]),_:1},8,["href"])])])])):(n(),i("div",gt,[t("div",yt,[t("div",wt,[l(k,{class:"h-24 w-24"})])]),kt,l(p,{href:o.route("shop"),class:"text-white font-semibold bg-lime-600 hover:bg-lime-700 px-8 py-3 rounded-full"},{default:f(()=>[x(" Belanja Sekarang ")]),_:1},8,["href"])]))])],64)}const St=b(Z,[["render",Ct]]);export{St as default};