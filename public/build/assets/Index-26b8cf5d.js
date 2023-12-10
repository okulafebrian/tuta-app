import{U as j}from"./UserLayout-774ee41c.js";import{_ as v,T as q,r as c,o,c as s,n as b,a as l,b as t,t as r,d as L,e as N,F as g,h as V,f as _,j as x}from"./app-e00fb960.js";import{r as B,a as M}from"./PlusIcon-17d6318e.js";import{r as w}from"./TrashIcon-bdaf90fb.js";import"./dialog-ed01fe28.js";import"./use-outside-click-2a9cf22d.js";import"./MagnifyingGlassIcon-d05987a5.js";import"./XMarkIcon-d2224846.js";import"./CheckCircleIcon-b5e872bb.js";const $={components:{MinusIcon:B,PlusIcon:M,TrashIcon:w},props:{modelValue:Number,max:Number,id:Number},watch:{"form.quantity"(){this.form.put(route("carts.update",this.id),{preserveScroll:!0}),this.$emit("update:modelValue",this.form.quantity)}},methods:{decrement(){this.form.quantity>1&&this.form.quantity--},increment(){this.form.quantity<this.max&&this.form.quantity++},remove(){this.$inertia.delete(route("carts.destroy",this.id))}},setup(d){return{form:q({quantity:d.modelValue})}}},S={class:"flex items-center border rounded-lg"},T={class:"text-center w-10"};function D(d,i,n,m,y,a){const f=c("MinusIcon"),p=c("TrashIcon"),h=c("PlusIcon");return o(),s("div",S,[m.form.quantity>1?(o(),s("button",{key:0,onClick:i[0]||(i[0]=(...u)=>a.decrement&&a.decrement(...u)),type:"button",class:b(["p-1.5 m-1",m.form.quantity==1?"text-slate-400 cursor-not-allowed":"text-lime-600 hover:bg-gray-100 rounded-md"])},[l(f,{class:"w-4 h-4",style:{"stroke-width":"3"}})],2)):(o(),s("button",{key:1,onClick:i[1]||(i[1]=(...u)=>a.remove&&a.remove(...u)),type:"button",class:"p-1.5 m-1 text-lime-600 hover:bg-gray-100 rounded-md"},[l(p,{class:"w-4 h-4 stroke-2"})])),t("div",T,r(m.form.quantity),1),t("button",{onClick:i[2]||(i[2]=(...u)=>a.increment&&a.increment(...u)),type:"button",class:b(["p-1.5 m-1",m.form.quantity==n.max?"text-slate-400 cursor-not-allowed":"text-lime-600 hover:bg-gray-100 rounded-md"])},[l(h,{class:"w-4 h-4",style:{"stroke-width":"3"}})],2)])}const H=v($,[["render",D]]),P={setup(){return{}}},R={class:"stroke-lime-600",width:"400px",height:"800px",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},K=t("path",{d:"M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z","stroke-width":"1.5"},null,-1),U=t("path",{d:"M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z","stroke-width":"1.5"},null,-1),O=t("path",{d:"M11.5 12.5L14.5 9.5M14.5 12.5L11.5 9.5","stroke-width":"1.5","stroke-linecap":"round"},null,-1),z=t("path",{d:"M2 3L2.26121 3.09184C3.5628 3.54945 4.2136 3.77826 4.58584 4.32298C4.95808 4.86771 4.95808 5.59126 4.95808 7.03836V9.76C4.95808 12.7016 5.02132 13.6723 5.88772 14.5862C6.75412 15.5 8.14857 15.5 10.9375 15.5H12M16.2404 15.5C17.8014 15.5 18.5819 15.5 19.1336 15.0504C19.6853 14.6008 19.8429 13.8364 20.158 12.3075L20.6578 9.88275C21.0049 8.14369 21.1784 7.27417 20.7345 6.69708C20.2906 6.12 18.7738 6.12 17.0888 6.12H11.0235M4.95808 6.12H7","stroke-width":"1.5","stroke-linecap":"round"},null,-1),F=[K,U,O,z];function Z(d,i,n,m,y,a){return o(),s("svg",R,F)}const E=v(P,[["render",Z]]),Y={data(){return{createIsOpen:!0}},props:{carts:Object,totalPrice:Number,flash:Object},components:{NumberInput:H,TrashIcon:w,Cart:E},layout:j},A={class:"h-full px-4 xl:px-24 py-10"},G={key:0},J=t("div",{class:"text-xl font-bold mb-6"},"Keranjang",-1),Q={class:"flex flex-col xl:flex-row gap-8 xl:gap-10"},W={class:"flex-1 divide-y"},X=["src"],tt={class:"flex-1 flex flex-col xl:flex-row justify-between gap-3 xl:gap-6"},et={class:"text-sm"},ot={class:"text-slate-600"},st={key:0,class:"flex gap-2"},nt={class:"text-red-600 font-semibold"},lt={class:"text-slate-400 line-through"},it={key:1,class:"font-semibold"},rt={class:"flex items-end h-full"},dt={class:"xl:w-1/3"},at={class:"border rounded-xl p-6"},ct=t("div",{class:"font-semibold"},"Ringkasan Belanja",-1),ut={class:"flex justify-between text-sm text-slate-600 my-4"},mt=t("div",null,"Total Harga",-1),ht={class:"border-t py-4 mb-4 flex justify-between font-semibold"},_t=t("div",null,"Total Belanja",-1),ft={key:1,class:"h-full flex items-center justify-center"},pt={class:"text-center"},xt={class:"flex justify-center mb-8"},bt={class:"bg-lime-100 rounded-full p-6"},vt=t("div",{class:"mb-8"},[t("div",{class:"text-xl xl:text-2xl font-bold mb-2"},"Keranjang Belanjamu Kosong"),t("div",{class:"text-sm xl:text-base"},"Yuk, cari sepatu wanita favoritmu di sini")],-1);function yt(d,i,n,m,y,a){const f=c("Head"),p=c("Notif"),h=c("Link"),u=c("NumberInput"),k=c("Cart");return o(),s(g,null,[l(f,{title:"Keranjang"}),n.flash.error||n.flash.success?(o(),L(p,{key:0,flash:n.flash},null,8,["flash"])):N("",!0),t("div",A,[n.carts.length>0?(o(),s("div",G,[J,t("div",Q,[t("div",W,[(o(!0),s(g,null,V(n.carts,(e,C)=>(o(),s("div",{class:b(["flex gap-6 py-6",{"pt-0":C==0}])},[l(h,{href:d.route("shop.product",[e.product.category,e.product])},{default:_(()=>[t("img",{src:"/storage/products/"+e.product.code+"/"+e.photo,class:"w-24 border rounded-lg p-2"},null,8,X)]),_:2},1032,["href"]),t("div",tt,[t("div",et,[l(h,{href:d.route("shop.product",[e.product.category,e.product]),class:"font-semibold line-clamp-1"},{default:_(()=>[x(r(e.product.name),1)]),_:2},1032,["href"]),t("div",ot,r(e.color.name)+", "+r(e.size.name),1),t("div",null,[e.product.is_discount?(o(),s("div",st,[t("div",nt," Rp"+r(e.product.discount_price.toLocaleString("id-ID")),1),t("div",lt," Rp"+r(e.product.price.toLocaleString("id-ID")),1)])):(o(),s("div",it,"Rp"+r(e.product.price.toLocaleString("id-ID")),1))])]),t("div",rt,[l(u,{modelValue:e.quantity,"onUpdate:modelValue":I=>e.quantity=I,id:e.id,max:e.stock},null,8,["modelValue","onUpdate:modelValue","id","max"])])])],2))),256))]),t("div",dt,[t("section",at,[ct,t("div",ut,[mt,t("div",null,"Rp"+r(n.totalPrice.toLocaleString("id-ID")),1)]),t("div",ht,[_t,t("div",null,"Rp"+r(n.totalPrice.toLocaleString("id-ID")),1)]),l(h,{href:d.route("checkout"),class:"block bg-lime-600 hover:bg-lime-700 py-3 w-full rounded-full font-semibold text-white text-center"},{default:_(()=>[x(" Beli ")]),_:1},8,["href"])])])])])):(o(),s("div",ft,[t("div",pt,[t("div",xt,[t("div",bt,[l(k,{class:"h-16 w-16 xl:h-20 xl:w-20"})])]),vt,l(h,{href:d.route("shop"),class:"text-white font-semibold bg-lime-600 hover:bg-lime-700 px-8 py-3 rounded-full"},{default:_(()=>[x(" Belanja Sekarang ")]),_:1},8,["href"])])]))])],64)}const Vt=v(Y,[["render",yt]]);export{Vt as default};
