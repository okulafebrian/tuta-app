import{o as r,c as o,b as t,_ as p,a2 as v,r as l,a,f as c,n as i}from"./app-a0f2337f.js";function u(e,n){return r(),o("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[t("path",{d:"M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z"}),t("path",{"fill-rule":"evenodd",d:"M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z","clip-rule":"evenodd"})])}function m(e,n){return r(),o("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[t("path",{"fill-rule":"evenodd",d:"M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z","clip-rule":"evenodd"})])}function g(e,n){return r(),o("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[t("path",{d:"M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"}),t("path",{d:"M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"})])}function _(e,n){return r(),o("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[t("path",{"fill-rule":"evenodd",d:"M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z","clip-rule":"evenodd"})])}const x={components:{Logo:v,HomeIcon:g,ShoppingBagIcon:_,ArchiveBoxIcon:u,ArrowLeftOnRectangleIcon:m}},w={class:"w-[15%] h-full fixed bg-white py-6"},b={class:"text-sm font-medium"},B=t("div",null,"Dashboard",-1),z=t("div",null,"Pesanan",-1),H=t("div",null,"Produk",-1);function I(e,n,$,A,C,V){const d=l("HomeIcon"),s=l("Link"),h=l("ShoppingBagIcon"),f=l("ArchiveBoxIcon");return r(),o("div",w,[t("div",b,[a(s,{href:e.route("dashboard"),class:i(["relative flex items-center gap-3 text-start w-full px-6 py-3 hover:bg-slate-100/80",e.$page.component==="Dashboard"?"text-lime-600 after:top-2 after:bottom-2 after:left-0 after:border-2 after:absolute after:border-lime-600":"text-gray-400"])},{default:c(()=>[a(d,{class:"w-5 h-5"}),B]),_:1},8,["href","class"]),a(s,{href:e.route("orders.manage"),class:i(["relative flex items-center gap-3 text-start w-full px-6 py-3 hover:bg-slate-100/80",e.$page.component.startsWith("Orders")?"text-lime-600 after:top-2 after:bottom-2 after:left-0 after:border-2 after:absolute after:border-lime-600":"text-gray-400"])},{default:c(()=>[a(h,{class:"w-5 h-5"}),z]),_:1},8,["href","class"]),a(s,{href:e.route("products.index"),class:i(["relative flex items-center gap-3 text-start w-full px-6 py-3 hover:bg-slate-100/80",e.$page.component.startsWith("Products")?"text-lime-600 after:top-2 after:bottom-2 after:left-0 after:border-2 after:absolute after:border-lime-600":"text-gray-400"])},{default:c(()=>[a(f,{class:"w-5 h-5"}),H]),_:1},8,["href","class"])])])}const M=p(x,[["render",I]]);export{M as S};
