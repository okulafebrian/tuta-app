import{S as re}from"./Status-ea838f34.js";import{p as j,q as T,s as R,u as h,x as Q,y as G,z as ne,A as oe,F as U,B as Y,C as K,o as _,c as g,b as a,_ as Z,r as N,a as S,t as b,e as q,f as ee,w as C,n as L,j as B}from"./app-a798eb3e.js";import{A as ue}from"./AdminLayout-e0f3cfa6.js";import{O as F,o as m,H as D,T as de,t as te,N as X,u as M,a as k,b as H,m as ie,P as $,c as I}from"./focus-management-2fce0f0b.js";import{b as ce}from"./use-resolve-button-type-01310c69.js";import{a as ve,f as ae,t as fe}from"./micro-task-84f21bb7.js";import"./CheckCircleIcon-b26d9947.js";let me=j({props:{onFocus:{type:Function,required:!0}},setup(e){let i=T(!0);return()=>i.value?R(ae,{as:"button",type:"button",features:ve.Focusable,onFocus(l){l.preventDefault();let v,n=50;function s(){var d;if(n--<=0){v&&cancelAnimationFrame(v);return}if((d=e.onFocus)!=null&&d.call(e)){i.value=!1,cancelAnimationFrame(v);return}v=requestAnimationFrame(s)}v=requestAnimationFrame(s)}}):null}});var pe=(e=>(e[e.Forwards=0]="Forwards",e[e.Backwards=1]="Backwards",e))(pe||{}),be=(e=>(e[e.Less=-1]="Less",e[e.Equal=0]="Equal",e[e.Greater=1]="Greater",e))(be||{});let se=Symbol("TabsContext");function V(e){let i=K(se,null);if(i===null){let l=new Error(`<${e} /> is missing a parent <TabGroup /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,V),l}return i}let J=Symbol("TabsSSRContext"),xe=j({name:"TabGroup",emits:{change:e=>!0},props:{as:{type:[Object,String],default:"template"},selectedIndex:{type:[Number],default:null},defaultIndex:{type:[Number],default:0},vertical:{type:[Boolean],default:!1},manual:{type:[Boolean],default:!1}},inheritAttrs:!1,setup(e,{slots:i,attrs:l,emit:v}){var n;let s=T((n=e.selectedIndex)!=null?n:e.defaultIndex),d=T([]),c=T([]),u=h(()=>e.selectedIndex!==null),x=h(()=>u.value?e.selectedIndex:s.value);function p(r){var t;let o=F(f.tabs.value,m),y=F(f.panels.value,m),z=o.filter(w=>{var P;return!((P=m(w))!=null&&P.hasAttribute("disabled"))});if(r<0||r>o.length-1){let w=M(s.value===null?0:Math.sign(r-s.value),{[-1]:()=>1,0:()=>M(Math.sign(r),{[-1]:()=>0,0:()=>0,1:()=>1}),1:()=>0}),P=M(w,{0:()=>o.indexOf(z[0]),1:()=>o.indexOf(z[z.length-1])});P!==-1&&(s.value=P),f.tabs.value=o,f.panels.value=y}else{let w=o.slice(0,r),P=[...o.slice(r),...w].find(le=>z.includes(le));if(!P)return;let W=(t=o.indexOf(P))!=null?t:f.selectedIndex.value;W===-1&&(W=f.selectedIndex.value),s.value=W,f.tabs.value=o,f.panels.value=y}}let f={selectedIndex:h(()=>{var r,t;return(t=(r=s.value)!=null?r:e.defaultIndex)!=null?t:null}),orientation:h(()=>e.vertical?"vertical":"horizontal"),activation:h(()=>e.manual?"manual":"auto"),tabs:d,panels:c,setSelectedIndex(r){x.value!==r&&v("change",r),u.value||p(r)},registerTab(r){var t;if(d.value.includes(r))return;let o=d.value[s.value];d.value.push(r),d.value=F(d.value,m);let y=(t=d.value.indexOf(o))!=null?t:s.value;y!==-1&&(s.value=y)},unregisterTab(r){let t=d.value.indexOf(r);t!==-1&&d.value.splice(t,1)},registerPanel(r){c.value.includes(r)||(c.value.push(r),c.value=F(c.value,m))},unregisterPanel(r){let t=c.value.indexOf(r);t!==-1&&c.value.splice(t,1)}};Q(se,f);let O=T({tabs:[],panels:[]}),A=T(!1);G(()=>{A.value=!0}),Q(J,h(()=>A.value?null:O.value));let E=h(()=>e.selectedIndex);return G(()=>{ne([E],()=>{var r;return p((r=e.selectedIndex)!=null?r:e.defaultIndex)},{immediate:!0})}),oe(()=>{if(!u.value||x.value==null||f.tabs.value.length<=0)return;let r=F(f.tabs.value,m);r.some((t,o)=>m(f.tabs.value[o])!==m(t))&&f.setSelectedIndex(r.findIndex(t=>m(t)===m(f.tabs.value[x.value])))}),()=>{let r={selectedIndex:s.value};return R(U,[d.value.length<=0&&R(me,{onFocus:()=>{for(let t of d.value){let o=m(t);if((o==null?void 0:o.tabIndex)===0)return o.focus(),!0}return!1}}),D({theirProps:{...l,...de(e,["selectedIndex","defaultIndex","manual","vertical","onChange"])},ourProps:{},slot:r,slots:i,attrs:l,name:"TabGroup"})])}}}),he=j({name:"TabList",props:{as:{type:[Object,String],default:"div"}},setup(e,{attrs:i,slots:l}){let v=V("TabList");return()=>{let n={selectedIndex:v.selectedIndex.value},s={role:"tablist","aria-orientation":v.orientation.value};return D({ourProps:s,theirProps:e,slot:n,attrs:i,slots:l,name:"TabList"})}}}),_e=j({name:"Tab",props:{as:{type:[Object,String],default:"button"},disabled:{type:[Boolean],default:!1},id:{type:String,default:()=>`headlessui-tabs-tab-${te()}`}},setup(e,{attrs:i,slots:l,expose:v}){let n=V("Tab"),s=T(null);v({el:s,$el:s}),G(()=>n.registerTab(s)),Y(()=>n.unregisterTab(s));let d=K(J),c=h(()=>{if(d.value){let t=d.value.tabs.indexOf(e.id);return t===-1?d.value.tabs.push(e.id)-1:t}return-1}),u=h(()=>{let t=n.tabs.value.indexOf(s);return t===-1?c.value:t}),x=h(()=>u.value===n.selectedIndex.value);function p(t){var o;let y=t();if(y===H.Success&&n.activation.value==="auto"){let z=(o=ie(s))==null?void 0:o.activeElement,w=n.tabs.value.findIndex(P=>m(P)===z);w!==-1&&n.setSelectedIndex(w)}return y}function f(t){let o=n.tabs.value.map(y=>m(y)).filter(Boolean);if(t.key===k.Space||t.key===k.Enter){t.preventDefault(),t.stopPropagation(),n.setSelectedIndex(u.value);return}switch(t.key){case k.Home:case k.PageUp:return t.preventDefault(),t.stopPropagation(),p(()=>$(o,I.First));case k.End:case k.PageDown:return t.preventDefault(),t.stopPropagation(),p(()=>$(o,I.Last))}if(p(()=>M(n.orientation.value,{vertical(){return t.key===k.ArrowUp?$(o,I.Previous|I.WrapAround):t.key===k.ArrowDown?$(o,I.Next|I.WrapAround):H.Error},horizontal(){return t.key===k.ArrowLeft?$(o,I.Previous|I.WrapAround):t.key===k.ArrowRight?$(o,I.Next|I.WrapAround):H.Error}}))===H.Success)return t.preventDefault()}let O=T(!1);function A(){var t;O.value||(O.value=!0,!e.disabled&&((t=m(s))==null||t.focus({preventScroll:!0}),n.setSelectedIndex(u.value),fe(()=>{O.value=!1})))}function E(t){t.preventDefault()}let r=ce(h(()=>({as:e.as,type:i.type})),s);return()=>{var t;let o={selected:x.value},{id:y,...z}=e,w={ref:s,onKeydown:f,onMousedown:E,onClick:A,id:y,role:"tab",type:r.value,"aria-controls":(t=m(n.panels.value[u.value]))==null?void 0:t.id,"aria-selected":x.value,tabIndex:x.value?0:-1,disabled:e.disabled?!0:void 0};return D({ourProps:w,theirProps:z,slot:o,attrs:i,slots:l,name:"Tab"})}}}),ge=j({name:"TabPanels",props:{as:{type:[Object,String],default:"div"}},setup(e,{slots:i,attrs:l}){let v=V("TabPanels");return()=>{let n={selectedIndex:v.selectedIndex.value};return D({theirProps:e,ourProps:{},slot:n,attrs:l,slots:i,name:"TabPanels"})}}}),ye=j({name:"TabPanel",props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},id:{type:String,default:()=>`headlessui-tabs-panel-${te()}`},tabIndex:{type:Number,default:0}},setup(e,{attrs:i,slots:l,expose:v}){let n=V("TabPanel"),s=T(null);v({el:s,$el:s}),G(()=>n.registerPanel(s)),Y(()=>n.unregisterPanel(s));let d=K(J),c=h(()=>{if(d.value){let p=d.value.panels.indexOf(e.id);return p===-1?d.value.panels.push(e.id)-1:p}return-1}),u=h(()=>{let p=n.panels.value.indexOf(s);return p===-1?c.value:p}),x=h(()=>u.value===n.selectedIndex.value);return()=>{var p;let f={selected:x.value},{id:O,tabIndex:A,...E}=e,r={ref:s,id:O,role:"tabpanel","aria-labelledby":(p=m(n.tabs.value[u.value]))==null?void 0:p.id,tabIndex:x.value?A:-1};return!x.value&&e.unmount&&!e.static?R(ae,{as:"span",...r}):D({ourProps:r,theirProps:E,slot:f,attrs:i,slots:l,features:X.Static|X.RenderStrategy,visible:x.value,name:"TabPanel"})}}});function we(e,i){return _(),g("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[a("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"})])}const Pe={components:{Status:re,PrinterIcon:we},methods:{accept(){this.$inertia.put(route("orders.accept",this.order))}},props:{order:Object}},ke={class:"bg-white rounded-lg shadow-sm"},Ie={class:"flex justify-between text-sm border-b px-4 py-3"},Se={class:"flex gap-2"},Te=a("div",{class:"text-zinc-200"},"/",-1),ze={class:"font-semibold"},Oe=a("div",{class:"text-zinc-200"},"/",-1),Ae={class:"text-zinc-600"},Ce=a("div",{class:"text-zinc-200"},"/",-1),Le={class:"text-zinc-600"},Be={key:0,class:"font-bold bg-red-600/10 px-2 text-red-600 rounded-sm"},$e={class:"grid grid-cols-3 px-4 py-3 divide-x text-sm"},je={class:"space-y-4"},Ee={class:"flex gap-4"},Fe=["src"],Ne={class:"flex-1"},De={class:"font-semibold"},Ve={class:"text-zinc-600"},qe={class:"px-6"},He=a("div",{class:"font-semibold mb-1"},"Alamat",-1),Me={class:"text-zinc-600"},Re={class:"space-y-4 px-6"},Ge=a("div",null,[a("div",{class:"font-semibold mb-1"},"Kurir"),a("div",{class:"text-zinc-600"},"J&T - Reguler")],-1),Ue={key:0},We=a("div",{class:"font-semibold mb-1"},"No. Resi",-1),Ke={class:"text-zinc-600"},Je={class:"px-4 py-3"},Qe={class:"flex items-center justify-between bg-zinc-100 px-4 py-2 rounded-md"},Xe=a("div",{class:"flex gap-1 text-sm"},[a("div",{class:"font-semibold"},"Total Penjualan"),a("div",{class:"font-medium text-zinc-600"},"(3 Barang)")],-1),Ye={class:"font-semibold"},Ze={class:"flex justify-between px-4 py-3 border-t"},et={class:"flex items-center gap-2"},tt=a("div",null,"Cetak Label",-1);function at(e,i,l,v,n,s){const d=N("Status"),c=N("PrinterIcon");return _(),g("div",ke,[a("div",Ie,[a("div",Se,[S(d,{status:l.order.status},null,8,["status"]),Te,a("div",ze,b(l.order.code),1),Oe,a("div",Ae,b(l.order.user.name),1),Ce,a("div",Le,b(l.order.formatted_created_at),1)]),l.order.cod?(_(),g("div",Be,"COD")):q("",!0)]),a("div",$e,[a("div",je,[(_(!0),g(U,null,ee(l.order.order_details,u=>(_(),g("div",Ee,[a("div",null,[a("img",{src:"/storage/shoes/"+u.code+"/"+u.photo,class:"w-14 ring-1 ring-gray-200 bg-white rounded-lg p-1"},null,8,Fe)]),a("div",Ne,[a("div",De,b(u.name),1),a("div",null,b(u.color)+", "+b(u.size),1),a("div",Ve,b(u.quantity)+" x Rp "+b(u.price.toLocaleString("id-ID")),1)])]))),256))]),a("div",qe,[He,a("div",Me,[a("div",null,b(l.order.address.name)+" ("+b(l.order.address.phone)+")",1),a("div",null,b(l.order.address.detail),1),a("div",null,b(l.order.address.district.name)+", "+b(l.order.address.city.name),1)])]),a("div",Re,[Ge,l.order.status!==1&&l.order.status!==3?(_(),g("div",Ue,[We,a("div",Ke,b(l.order.shipping.awb_no),1)])):q("",!0)])]),a("div",Je,[a("div",Qe,[Xe,a("div",Ye,"Rp "+b(l.order.total_payment.toLocaleString("id-ID")),1)])]),a("div",Ze,[a("div",null,[a("button",{type:"button",onClick:i[0]||(i[0]=(...u)=>s.accept&&s.accept(...u)),class:"p-2.5 font-medium hover:bg-gray-100 text-sm rounded-lg"},[a("div",et,[S(c,{class:"w-4 h-4"}),tt])])]),a("div",null,[l.order.status===1?(_(),g("button",{key:0,type:"button",onClick:i[1]||(i[1]=(...u)=>s.accept&&s.accept(...u)),class:"px-6 py-2.5 font-semibold bg-lime-600 hover:bg-lime-700 text-white text-sm rounded-lg"}," Terima Pesanan ")):q("",!0),l.order.status===4?(_(),g("button",{key:1,type:"button",onClick:i[2]||(i[2]=(...u)=>s.accept&&s.accept(...u)),class:"px-6 py-2.5 font-semibold bg-lime-600 hover:bg-lime-700 text-white text-sm rounded-lg"}," Request Pick Up ")):q("",!0)])])])}const st=Z(Pe,[["render",at]]),lt={components:{TabGroup:xe,TabList:he,Tab:_e,TabPanels:ge,TabPanel:ye,OrderCard:st},props:{orders:Object},layout:ue},rt={class:"px-20 py-10"},nt=a("div",{class:"text-xl font-semibold mb-6"},"Daftar Pesanan",-1),ot={class:"flex p-3 gap-4 text-sm font-semibold bg-white rounded-lg shadow-sm mb-4"},ut={key:0,class:"space-y-4"},dt={key:1,class:"text-center py-16 text-2xl text-slate-500 font-semibold"};function it(e,i,l,v,n,s){const d=N("Head"),c=N("Link"),u=N("OrderCard");return _(),g(U,null,[S(d,{title:"Daftar Pesanan"}),a("div",rt,[nt,a("div",ot,[a("div",null,[S(c,{href:e.route("orders.manage"),class:L(["p-4 relative",e.$page.url==="/orders/manage"?"text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600":"text-zinc-500"])},{default:C(()=>[B(" Semua Pesanan ")]),_:1},8,["href","class"])]),a("div",null,[S(c,{href:e.route("orders.manage",{status:"baru"}),class:L(["p-4 relative",e.$page.url==="/orders/manage?status=baru"?"text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600":"text-zinc-500"])},{default:C(()=>[B(" Pesanan Baru ")]),_:1},8,["href","class"])]),a("div",null,[S(c,{href:e.route("orders.manage",{status:"siap_dikirim"}),class:L(["p-4 relative",e.$page.url==="/orders/manage?status=siap_dikirim"?"text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600":"text-zinc-500"])},{default:C(()=>[B(" Siap Dikirim ")]),_:1},8,["href","class"])]),a("div",null,[S(c,{href:e.route("orders.manage",{status:"dalam_pengiriman"}),class:L(["p-4 relative",e.$page.url==="/orders/manage?status=dalam_pengiriman"?"text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600":"text-zinc-500"])},{default:C(()=>[B(" Dalam Pengiriman ")]),_:1},8,["href","class"])]),a("div",null,[S(c,{href:e.route("orders.manage",{status:"selesai"}),class:L(["p-4 relative",e.$page.url==="/orders/manage?status=selesai"?"text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600":"text-zinc-500"])},{default:C(()=>[B(" Pesanan Selesai ")]),_:1},8,["href","class"])]),a("div",null,[S(c,{href:e.route("orders.manage",{status:"dibatalkan"}),class:L(["p-4 relative",e.$page.url==="/orders/manage?status=dibatalkan"?"text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600":"text-zinc-500"])},{default:C(()=>[B(" Dibatalkan ")]),_:1},8,["href","class"])])]),l.orders.length>0?(_(),g("div",ut,[(_(!0),g(U,null,ee(l.orders,x=>(_(),g("div",null,[S(u,{order:x},null,8,["order"])]))),256))])):(_(),g("div",dt," Pesanan tidak ditemukan "))])],64)}const ht=Z(lt,[["render",it]]);export{ht as default};