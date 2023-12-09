import{U as f}from"./UserLayout-8888f4ae.js";import{o as n,c as a,b as e,_ as p,r as c,a as o,f as s,e as m,j as i}from"./app-a0f2337f.js";import"./dialog-462821c4.js";import"./use-outside-click-eb249b35.js";import"./MagnifyingGlassIcon-6744ffad.js";import"./XMarkIcon-9b5d6da3.js";import"./CheckCircleIcon-7c336ff1.js";function x(t,d){return n(),a("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M16.403 12.652a3 3 0 000-5.304 3 3 0 00-3.75-3.751 3 3 0 00-5.305 0 3 3 0 00-3.751 3.75 3 3 0 000 5.305 3 3 0 003.75 3.751 3 3 0 005.305 0 3 3 0 003.751-3.75zm-2.546-4.46a.75.75 0 00-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z","clip-rule":"evenodd"})])}function b(t,d){return n(),a("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z","clip-rule":"evenodd"})])}function g(t,d){return n(),a("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z","clip-rule":"evenodd"})])}const v={components:{CheckBadgeIcon:x,ClockIcon:b,XCircleIcon:g},props:{status:Number,order:Object},layout:f},w={class:"px-4 lg:px-20 py-10"},y={key:0},k={class:"text-center mb-6"},C=e("div",{class:"text-3xl font-semibold mb-2"},"Pesananmu Berhasil Dibuat",-1),B=e("div",null,"Pembayaranmu telah berhasil diproses. Terimakasih telah berbelanja di TUTA Official Shop.",-1),L={class:"flex justify-center gap-3"},j={key:1},I={class:"text-center mb-6"},P=e("div",{class:"text-3xl font-semibold mb-2"},"Menunggu Pembayaran",-1),z=e("div",null,"Selesaikan pembayaranmu untuk menghindari pembatalan otomatis.",-1),M={class:"flex justify-center gap-3"},N=["href"],V={key:2},S={class:"text-center mb-6"},T=e("div",{class:"text-3xl font-semibold mb-2"},"Pesananmu Gagal Dibuat",-1),U=e("div",null,"Pembayaranmu gagal diproses.",-1),X={class:"flex justify-center gap-3"};function D(t,d,l,O,$,A){const u=c("CheckBadgeIcon"),r=c("Link"),h=c("ClockIcon"),_=c("XCircleIcon");return n(),a("div",w,[l.status==2?(n(),a("div",y,[e("div",k,[o(u,{class:"text-lime-600 w-20 h-20 inline-block mb-6"}),C,B]),e("div",L,[o(r,{href:t.route("shop"),class:"bg-lime-600 px-6 py-2.5 rounded-lg font-medium text-white text-center"},{default:s(()=>[i(" Belanja Lagi ")]),_:1},8,["href"]),o(r,{href:t.route("orders.index"),class:"border border-lime-600 px-6 py-2.5 rounded-lg font-medium text-lime-600 text-center"},{default:s(()=>[i(" Pesanan Saya ")]),_:1},8,["href"])])])):m("",!0),l.status==1?(n(),a("div",j,[e("div",I,[o(h,{class:"text-lime-600 w-20 h-20 inline-block mb-6"}),P,z]),e("div",M,[o(r,{href:t.route("shop"),class:"border border-lime-600 px-6 py-2.5 rounded-lg font-medium text-lime-600 text-center"},{default:s(()=>[i(" Belanja Lagi ")]),_:1},8,["href"]),e("a",{href:l.order.redirect_url,target:"_blank",class:"bg-lime-600 px-6 py-2.5 rounded-lg font-medium text-white text-center"}," Lanjut ke Pembayaran ",8,N)])])):m("",!0),l.status==6?(n(),a("div",V,[e("div",S,[o(_,{class:"text-lime-600 w-20 h-20 inline-block mb-6"}),T,U]),e("div",X,[o(r,{href:t.route("home"),class:"bg-lime-600 px-6 py-2.5 rounded-lg font-medium text-white text-center"},{default:s(()=>[i(" Belanja Lagi ")]),_:1},8,["href"]),o(r,{href:t.route("orders"),class:"border border-lime-600 px-6 py-2.5 rounded-lg font-medium text-lime-600 text-center"},{default:s(()=>[i(" Pesanan Saya ")]),_:1},8,["href"])])])):m("",!0)])}const Q=p(v,[["render",D]]);export{Q as default};