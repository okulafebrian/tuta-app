import{_ as u}from"./GuestLayout-de0b3a49.js";import{o,f as a,b as t,O as h,r as i,c as f,w as v,F as p,j as x,t as s,d,a as b}from"./app-541a671a.js";import{_ as y}from"./_plugin-vue_export-helper-c27b6911.js";function g(n,r){return o(),a("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"})])}const w={components:{GuestLayout:u,TrashIcon:g},props:{shoes:Object,total:Number},methods:{formatNumber(n){return n.toLocaleString("id-ID")},remove(n){h.delete(route("cart.remove",n))}}},k={class:"px-4 lg:px-20 py-24"},j={class:"flex gap-20"},L={class:"w-2/3"},N=t("h2",{class:"text-xl font-semibold mb-2"},"Keranjang",-1),B={key:0,class:"grid divide-y"},C={class:"flex justify-between py-4"},T={class:"font-medium"},I={class:"flex gap-5"},R={class:"text-sm ml-1"},G={class:"text-sm ml-1"},O={class:"flex flex-col justify-between items-end"},S={class:"font-medium"},V=["onClick"],z={key:1,class:"mt-4 text-zinc-500"},D={class:"w-1/3"},F=t("h2",{class:"text-xl font-semibold mb-6"},"Ringkasan Belanja",-1),K={class:"flex justify-between"},q=t("div",null,"Subtotal",-1),E=t("hr",{class:"my-2"},null,-1),H={class:"flex justify-between mb-8"},J=t("div",null,"Total",-1),M=t("button",{class:"py-3 w-full font-medium text-white bg-lime-600 hover:bg-lime-700 rounded-full"}," Beli ",-1);function U(n,r,l,A,P,c){const _=i("TrashIcon"),m=i("GuestLayout");return o(),f(m,null,{default:v(()=>[t("div",k,[t("div",j,[t("div",L,[N,l.shoes.length>0?(o(),a("div",B,[(o(!0),a(p,null,x(l.shoes,e=>(o(),a("div",C,[t("div",null,[t("h5",T,s(e.name),1),t("p",null,s(e.category),1),t("p",null,s(e.color),1),t("div",I,[t("div",null,[d("Ukuran "),t("span",R,s(e.size),1)]),t("div",null,[d("Jumlah "),t("span",G,s(e.quantity),1)])])]),t("div",O,[t("div",S," Rp"+s(c.formatNumber(e.discount_price??e.price)),1),t("div",null,[t("button",{type:"button",onClick:Q=>c.remove(e.key)},[b(_,{class:"w-6 h-6"})],8,V)])])]))),256))])):(o(),a("div",z," Keranjang anda masih kosong "))]),t("div",D,[F,t("div",K,[q,t("div",null,"Rp"+s(c.formatNumber(l.total)),1)]),E,t("div",H,[J,t("div",null,"Rp"+s(c.formatNumber(l.total)),1)]),M])])])]),_:1})}const Z=y(w,[["render",U]]);export{Z as default};