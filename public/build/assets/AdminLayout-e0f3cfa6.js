import{_ as d,r as c,o as i,c as f,b as r,a as s,w as t,j as a,R as u}from"./app-a798eb3e.js";import{r as $}from"./CheckCircleIcon-b26d9947.js";const g={},b={class:"fixed top-0 z-10 px-20 py-4 shadow-sm w-full bg-white"},x={class:"flex items-center justify-between"},v={class:"flex items-center gap-16"},k={class:"space-x-6 text-sm font-medium"};function w(e,l,_,h,m,p){const n=c("Logo"),o=c("Link");return i(),f("nav",b,[r("div",x,[r("div",v,[s(o,{href:e.route("dashboard")},{default:t(()=>[s(n,{class:"h-8"})]),_:1},8,["href"]),r("div",k,[s(o,{href:e.route("dashboard")},{default:t(()=>[a("Dashboard")]),_:1},8,["href"]),s(o,{href:e.route("orders.manage")},{default:t(()=>[a("Pesanan")]),_:1},8,["href"]),s(o,{href:e.route("shoes.index")},{default:t(()=>[a("Produk")]),_:1},8,["href"])])]),s(o,{href:e.route("admin.logout"),method:"post",as:"button",class:"text-sm font-medium"},{default:t(()=>[a(" Logout ")]),_:1},8,["href"])])])}const L=d(g,[["render",w]]),N={data(){return{isOpen:!1}},components:{AdminNavbar:L,CheckCircleIcon:$},createad(){return{message:this.$page.props.flash.message}}},y={class:"h-screen flex flex-col"},A={class:"py-16 flex-1 bg-gray-100"};function C(e,l,_,h,m,p){const n=c("AdminNavbar");return i(),f("div",y,[s(n),r("div",A,[u(e.$slots,"default")])])}const j=d(N,[["render",C]]);export{j as A};