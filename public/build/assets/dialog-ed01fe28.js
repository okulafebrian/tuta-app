import{u as L,H as $,x as p,a4 as Oe,D as W,z as c,B as P,J as F,y as b,F as Ce,C as z,E as h,M as de,L as _,A as k,K as A,R as Re,O as Ae,a5 as Me,a6 as ce,I as te,a0 as ke,N as ue,V as He,a1 as U}from"./app-e00fb960.js";import{a as Ne,S as R,m as I,P as q,N as D,T as xe,y as Be,o as je}from"./use-outside-click-2a9cf22d.js";var Y=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(Y||{});let Q=L({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(e,{slots:t,attrs:l}){return()=>{let{features:n,...a}=e,o={"aria-hidden":(n&2)===2?!0:void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(n&4)===4&&(n&2)!==2&&{display:"none"}}};return $({ourProps:o,theirProps:a,slot:{},attrs:l,slots:t,name:"Hidden"})}}});function We(){return/iPhone/gi.test(window.navigator.platform)||/Mac/gi.test(window.navigator.platform)&&window.navigator.maxTouchPoints>0}var j=(e=>(e[e.Forwards=0]="Forwards",e[e.Backwards=1]="Backwards",e))(j||{});function Ie(){let e=p(0);return Ne("keydown",t=>{t.key==="Tab"&&(e.value=t.shiftKey?1:0)}),e}function fe(e,t,l,n){Oe.isServer||W(a=>{e=e??window,e.addEventListener(t,l,n),a(()=>e.removeEventListener(t,l,n))})}function Ve(e){function t(){document.readyState!=="loading"&&(e(),document.removeEventListener("DOMContentLoaded",t))}typeof window<"u"&&typeof document<"u"&&(document.addEventListener("DOMContentLoaded",t),t())}function pe(e){if(!e)return new Set;if(typeof e=="function")return new Set(e());let t=new Set;for(let l of e.value){let n=h(l);n instanceof HTMLElement&&t.add(n)}return t}var ve=(e=>(e[e.None=1]="None",e[e.InitialFocus=2]="InitialFocus",e[e.TabLock=4]="TabLock",e[e.FocusLock=8]="FocusLock",e[e.RestoreFocus=16]="RestoreFocus",e[e.All=30]="All",e))(ve||{});let x=Object.assign(L({name:"FocusTrap",props:{as:{type:[Object,String],default:"div"},initialFocus:{type:Object,default:null},features:{type:Number,default:30},containers:{type:[Object,Function],default:p(new Set)}},inheritAttrs:!1,setup(e,{attrs:t,slots:l,expose:n}){let a=p(null);n({el:a,$el:a});let o=c(()=>I(a)),r=p(!1);P(()=>r.value=!0),F(()=>r.value=!1),Ge({ownerDocument:o},c(()=>r.value&&!!(e.features&16)));let u=qe({ownerDocument:o,container:a,initialFocus:c(()=>e.initialFocus)},c(()=>r.value&&!!(e.features&2)));_e({ownerDocument:o,container:a,containers:e.containers,previousActiveElement:u},c(()=>r.value&&!!(e.features&8)));let i=Ie();function s(g){let y=h(a);y&&(E=>E())(()=>{_(i.value,{[j.Forwards]:()=>{q(y,D.First,{skipElements:[g.relatedTarget]})},[j.Backwards]:()=>{q(y,D.Last,{skipElements:[g.relatedTarget]})}})})}let f=p(!1);function w(g){g.key==="Tab"&&(f.value=!0,requestAnimationFrame(()=>{f.value=!1}))}function m(g){if(!r.value)return;let y=pe(e.containers);h(a)instanceof HTMLElement&&y.add(h(a));let E=g.relatedTarget;E instanceof HTMLElement&&E.dataset.headlessuiFocusGuard!=="true"&&(me(y,E)||(f.value?q(h(a),_(i.value,{[j.Forwards]:()=>D.Next,[j.Backwards]:()=>D.Previous})|D.WrapAround,{relativeTo:g.target}):g.target instanceof HTMLElement&&R(g.target)))}return()=>{let g={},y={ref:a,onKeydown:w,onFocusout:m},{features:E,initialFocus:ne,containers:ae,...H}=e;return b(Ce,[!!(E&4)&&b(Q,{as:"button",type:"button","data-headlessui-focus-guard":!0,onFocus:s,features:Y.Focusable}),$({ourProps:y,theirProps:{...t,...H},slot:g,attrs:t,slots:l,name:"FocusTrap"}),!!(E&4)&&b(Q,{as:"button",type:"button","data-headlessui-focus-guard":!0,onFocus:s,features:Y.Focusable})])}}}),{features:ve}),O=[];Ve(()=>{function e(t){t.target instanceof HTMLElement&&t.target!==document.body&&O[0]!==t.target&&(O.unshift(t.target),O=O.filter(l=>l!=null&&l.isConnected),O.splice(10))}window.addEventListener("click",e,{capture:!0}),window.addEventListener("mousedown",e,{capture:!0}),window.addEventListener("focus",e,{capture:!0}),document.body.addEventListener("click",e,{capture:!0}),document.body.addEventListener("mousedown",e,{capture:!0}),document.body.addEventListener("focus",e,{capture:!0})});function Ue(e){let t=p(O.slice());return z([e],([l],[n])=>{n===!0&&l===!1?de(()=>{t.value.splice(0)}):n===!1&&l===!0&&(t.value=O.slice())},{flush:"post"}),()=>{var l;return(l=t.value.find(n=>n!=null&&n.isConnected))!=null?l:null}}function Ge({ownerDocument:e},t){let l=Ue(t);P(()=>{W(()=>{var n,a;t.value||((n=e.value)==null?void 0:n.activeElement)===((a=e.value)==null?void 0:a.body)&&R(l())},{flush:"post"})}),F(()=>{t.value&&R(l())})}function qe({ownerDocument:e,container:t,initialFocus:l},n){let a=p(null),o=p(!1);return P(()=>o.value=!0),F(()=>o.value=!1),P(()=>{z([t,l,n],(r,u)=>{if(r.every((s,f)=>(u==null?void 0:u[f])===s)||!n.value)return;let i=h(t);i&&de(()=>{var s,f;if(!o.value)return;let w=h(l),m=(s=e.value)==null?void 0:s.activeElement;if(w){if(w===m){a.value=m;return}}else if(i.contains(m)){a.value=m;return}w?R(w):q(i,D.First|D.NoScroll)===xe.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),a.value=(f=e.value)==null?void 0:f.activeElement})},{immediate:!0,flush:"post"})}),a}function _e({ownerDocument:e,container:t,containers:l,previousActiveElement:n},a){var o;fe((o=e.value)==null?void 0:o.defaultView,"focus",r=>{if(!a.value)return;let u=pe(l);h(t)instanceof HTMLElement&&u.add(h(t));let i=n.value;if(!i)return;let s=r.target;s&&s instanceof HTMLElement?me(u,s)?(n.value=s,R(s)):(r.preventDefault(),r.stopPropagation(),R(i)):R(n.value)},!0)}function me(e,t){for(let l of e)if(l.contains(t))return!0;return!1}let K=new Map,B=new Map;function ie(e,t=p(!0)){W(l=>{var n;if(!t.value)return;let a=h(e);if(!a)return;l(function(){var r;if(!a)return;let u=(r=B.get(a))!=null?r:1;if(u===1?B.delete(a):B.set(a,u-1),u!==1)return;let i=K.get(a);i&&(i["aria-hidden"]===null?a.removeAttribute("aria-hidden"):a.setAttribute("aria-hidden",i["aria-hidden"]),a.inert=i.inert,K.delete(a))});let o=(n=B.get(a))!=null?n:0;B.set(a,o+1),o===0&&(K.set(a,{"aria-hidden":a.getAttribute("aria-hidden"),inert:a.inert}),a.setAttribute("aria-hidden","true"),a.inert=!0)})}let ge=Symbol("ForcePortalRootContext");function Ye(){return A(ge,!1)}let se=L({name:"ForcePortalRoot",props:{as:{type:[Object,String],default:"template"},force:{type:Boolean,default:!1}},setup(e,{slots:t,attrs:l}){return k(ge,e.force),()=>{let{force:n,...a}=e;return $({theirProps:a,ourProps:{},slot:{},slots:t,attrs:l,name:"ForcePortalRoot"})}}});function ze(e){let t=I(e);if(!t){if(e===null)return null;throw new Error(`[Headless UI]: Cannot find ownerDocument for contextElement: ${e}`)}let l=t.getElementById("headlessui-portal-root");if(l)return l;let n=t.createElement("div");return n.setAttribute("id","headlessui-portal-root"),t.body.appendChild(n)}let Je=L({name:"Portal",props:{as:{type:[Object,String],default:"div"}},setup(e,{slots:t,attrs:l}){let n=p(null),a=c(()=>I(n)),o=Ye(),r=A(he,null),u=p(o===!0||r==null?ze(n.value):r.resolveTarget());W(()=>{o||r!=null&&(u.value=r.resolveTarget())});let i=A(X,null);return P(()=>{let s=h(n);s&&i&&F(i.register(s))}),F(()=>{var s,f;let w=(s=a.value)==null?void 0:s.getElementById("headlessui-portal-root");w&&u.value===w&&u.value.children.length<=0&&((f=u.value.parentElement)==null||f.removeChild(u.value))}),()=>{if(u.value===null)return null;let s={ref:n,"data-headlessui-portal":""};return b(Re,{to:u.value},$({ourProps:s,theirProps:e,slot:{},attrs:l,slots:t,name:"Portal"}))}}}),X=Symbol("PortalParentContext");function Ke(){let e=A(X,null),t=p([]);function l(o){return t.value.push(o),e&&e.register(o),()=>n(o)}function n(o){let r=t.value.indexOf(o);r!==-1&&t.value.splice(r,1),e&&e.unregister(o)}let a={register:l,unregister:n,portals:t};return[t,L({name:"PortalWrapper",setup(o,{slots:r}){return k(X,a),()=>{var u;return(u=r.default)==null?void 0:u.call(r)}}})]}let he=Symbol("PortalGroupContext"),Qe=L({name:"PortalGroup",props:{as:{type:[Object,String],default:"template"},target:{type:Object,default:null}},setup(e,{attrs:t,slots:l}){let n=Ae({resolveTarget(){return e.target}});return k(he,n),()=>{let{target:a,...o}=e;return $({theirProps:o,ourProps:{},slot:{},attrs:t,slots:l,name:"PortalGroup"})}}}),we=Symbol("StackContext");var Z=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(Z||{});function Xe(){return A(we,()=>{})}function Ze({type:e,enabled:t,element:l,onUpdate:n}){let a=Xe();function o(...r){n==null||n(...r),a(...r)}P(()=>{z(t,(r,u)=>{r?o(0,e,l):u===!0&&o(1,e,l)},{immediate:!0,flush:"sync"})}),F(()=>{t.value&&o(1,e,l)}),k(we,o)}let et=Symbol("DescriptionContext");function tt({slot:e=p({}),name:t="Description",props:l={}}={}){let n=p([]);function a(o){return n.value.push(o),()=>{let r=n.value.indexOf(o);r!==-1&&n.value.splice(r,1)}}return k(et,{register:a,slot:e,name:t,props:l}),c(()=>n.value.length>0?n.value.join(" "):void 0)}function lt(e){let t=Me(e.getSnapshot());return F(e.subscribe(()=>{t.value=e.getSnapshot()})),t}function nt(e,t){let l=e(),n=new Set;return{getSnapshot(){return l},subscribe(a){return n.add(a),()=>n.delete(a)},dispatch(a,...o){let r=t[a].call(l,...o);r&&(l=r,n.forEach(u=>u()))}}}function at(){let e;return{before({doc:t}){var l;let n=t.documentElement;e=((l=t.defaultView)!=null?l:window).innerWidth-n.clientWidth},after({doc:t,d:l}){let n=t.documentElement,a=n.clientWidth-n.offsetWidth,o=e-a;l.style(n,"paddingRight",`${o}px`)}}}function ot(){if(!We())return{};let e;return{before(){e=window.pageYOffset},after({doc:t,d:l,meta:n}){function a(r){return n.containers.flatMap(u=>u()).some(u=>u.contains(r))}if(window.getComputedStyle(t.documentElement).scrollBehavior!=="auto"){let r=ce();r.style(t.documentElement,"scroll-behavior","auto"),l.add(()=>l.microTask(()=>r.dispose()))}l.style(t.body,"marginTop",`-${e}px`),window.scrollTo(0,0);let o=null;l.addEventListener(t,"click",r=>{if(r.target instanceof HTMLElement)try{let u=r.target.closest("a");if(!u)return;let{hash:i}=new URL(u.href),s=t.querySelector(i);s&&!a(s)&&(o=s)}catch{}},!0),l.addEventListener(t,"touchmove",r=>{r.target instanceof HTMLElement&&!a(r.target)&&r.preventDefault()},{passive:!1}),l.add(()=>{window.scrollTo(0,window.pageYOffset+e),o&&o.isConnected&&(o.scrollIntoView({block:"nearest"}),o=null)})}}}function rt(){return{before({doc:e,d:t}){t.style(e.documentElement,"overflow","hidden")}}}function ut(e){let t={};for(let l of e)Object.assign(t,l(t));return t}let C=nt(()=>new Map,{PUSH(e,t){var l;let n=(l=this.get(e))!=null?l:{doc:e,count:0,d:ce(),meta:new Set};return n.count++,n.meta.add(t),this.set(e,n),this},POP(e,t){let l=this.get(e);return l&&(l.count--,l.meta.delete(t)),this},SCROLL_PREVENT({doc:e,d:t,meta:l}){let n={doc:e,d:t,meta:ut(l)},a=[ot(),at(),rt()];a.forEach(({before:o})=>o==null?void 0:o(n)),a.forEach(({after:o})=>o==null?void 0:o(n))},SCROLL_ALLOW({d:e}){e.dispose()},TEARDOWN({doc:e}){this.delete(e)}});C.subscribe(()=>{let e=C.getSnapshot(),t=new Map;for(let[l]of e)t.set(l,l.documentElement.style.overflow);for(let l of e.values()){let n=t.get(l.doc)==="hidden",a=l.count!==0;(a&&!n||!a&&n)&&C.dispatch(l.count>0?"SCROLL_PREVENT":"SCROLL_ALLOW",l),l.count===0&&C.dispatch("TEARDOWN",l)}});function it(e,t,l){let n=lt(C),a=c(()=>{let o=e.value?n.value.get(e.value):void 0;return o?o.count>0:!1});return z([e,t],([o,r],[u],i)=>{if(!o||!r)return;C.dispatch("PUSH",o,l);let s=!1;i(()=>{s||(C.dispatch("POP",u??o,l),s=!0)})},{immediate:!0}),a}function st({defaultContainers:e=[],portals:t,mainTreeNodeRef:l}={}){let n=p(null),a=I(n);function o(){var r;let u=[];for(let i of e)i!==null&&(i instanceof HTMLElement?u.push(i):"value"in i&&i.value instanceof HTMLElement&&u.push(i.value));if(t!=null&&t.value)for(let i of t.value)u.push(i);for(let i of(r=a==null?void 0:a.querySelectorAll("html > *, body > *"))!=null?r:[])i!==document.body&&i!==document.head&&i instanceof HTMLElement&&i.id!=="headlessui-portal-root"&&(i.contains(h(n))||u.some(s=>i.contains(s))||u.push(i));return u}return{resolveContainers:o,contains(r){return o().some(u=>u.contains(r))},mainTreeNodeRef:n,MainTreeNode(){return l!=null?null:b(Q,{features:Y.Hidden,ref:n})}}}var dt=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(dt||{});let ee=Symbol("DialogContext");function le(e){let t=A(ee,null);if(t===null){let l=new Error(`<${e} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,le),l}return t}let G="DC8F892D-2EBD-447C-A4C8-A03058436FF4",pt=L({name:"Dialog",inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},open:{type:[Boolean,String],default:G},initialFocus:{type:Object,default:null},id:{type:String,default:()=>`headlessui-dialog-${te()}`}},emits:{close:e=>!0},setup(e,{emit:t,attrs:l,slots:n,expose:a}){var o;let r=p(!1);P(()=>{r.value=!0});let u=p(0),i=ke(),s=c(()=>e.open===G&&i!==null?(i.value&U.Open)===U.Open:e.open),f=p(null),w=c(()=>I(f));if(a({el:f,$el:f}),!(e.open!==G||i!==null))throw new Error("You forgot to provide an `open` prop to the `Dialog`.");if(typeof s.value!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${s.value===G?void 0:e.open}`);let m=c(()=>r.value&&s.value?0:1),g=c(()=>m.value===0),y=c(()=>u.value>1),E=A(ee,null)!==null,[ne,ae]=Ke(),{resolveContainers:H,mainTreeNodeRef:oe,MainTreeNode:ye}=st({portals:ne,defaultContainers:[c(()=>{var d;return(d=N.panelRef.value)!=null?d:f.value})]}),be=c(()=>y.value?"parent":"leaf"),re=c(()=>i!==null?(i.value&U.Closing)===U.Closing:!1),Ee=c(()=>E||re.value?!1:g.value),Te=c(()=>{var d,v,T;return(T=Array.from((v=(d=w.value)==null?void 0:d.querySelectorAll("body > *"))!=null?v:[]).find(S=>S.id==="headlessui-portal-root"?!1:S.contains(h(oe))&&S instanceof HTMLElement))!=null?T:null});ie(Te,Ee);let Se=c(()=>y.value?!0:g.value),Le=c(()=>{var d,v,T;return(T=Array.from((v=(d=w.value)==null?void 0:d.querySelectorAll("[data-headlessui-portal]"))!=null?v:[]).find(S=>S.contains(h(oe))&&S instanceof HTMLElement))!=null?T:null});ie(Le,Se),Ze({type:"Dialog",enabled:c(()=>m.value===0),element:f,onUpdate:(d,v)=>{if(v==="Dialog")return _(d,{[Z.Add]:()=>u.value+=1,[Z.Remove]:()=>u.value-=1})}});let Pe=tt({name:"DialogDescription",slot:c(()=>({open:s.value}))}),V=p(null),N={titleId:V,panelRef:p(null),dialogState:m,setTitleId(d){V.value!==d&&(V.value=d)},close(){t("close",!1)}};k(ee,N);let Fe=c(()=>!(!g.value||y.value));Be(H,(d,v)=>{N.close(),He(()=>v==null?void 0:v.focus())},Fe);let $e=c(()=>!(y.value||m.value!==0));fe((o=w.value)==null?void 0:o.defaultView,"keydown",d=>{$e.value&&(d.defaultPrevented||d.key===je.Escape&&(d.preventDefault(),d.stopPropagation(),N.close()))});let De=c(()=>!(re.value||m.value!==0||E));return it(w,De,d=>{var v;return{containers:[...(v=d.containers)!=null?v:[],H]}}),W(d=>{if(m.value!==0)return;let v=h(f);if(!v)return;let T=new ResizeObserver(S=>{for(let J of S){let M=J.target.getBoundingClientRect();M.x===0&&M.y===0&&M.width===0&&M.height===0&&N.close()}});T.observe(v),d(()=>T.disconnect())}),()=>{let{id:d,open:v,initialFocus:T,...S}=e,J={...l,ref:f,id:d,role:"dialog","aria-modal":m.value===0?!0:void 0,"aria-labelledby":V.value,"aria-describedby":Pe.value},M={open:m.value===0};return b(se,{force:!0},()=>[b(Je,()=>b(Qe,{target:f.value},()=>b(se,{force:!1},()=>b(x,{initialFocus:T,containers:H,features:g.value?_(be.value,{parent:x.features.RestoreFocus,leaf:x.features.All&~x.features.FocusLock}):x.features.None},()=>b(ae,{},()=>$({ourProps:J,theirProps:{...S,...l},slot:M,attrs:l,slots:n,visible:m.value===0,features:ue.RenderStrategy|ue.Static,name:"Dialog"})))))),b(ye)])}}}),vt=L({name:"DialogPanel",props:{as:{type:[Object,String],default:"div"},id:{type:String,default:()=>`headlessui-dialog-panel-${te()}`}},setup(e,{attrs:t,slots:l,expose:n}){let a=le("DialogPanel");n({el:a.panelRef,$el:a.panelRef});function o(r){r.stopPropagation()}return()=>{let{id:r,...u}=e,i={id:r,ref:a.panelRef,onClick:o};return $({ourProps:i,theirProps:u,slot:{open:a.dialogState.value===0},attrs:t,slots:l,name:"DialogPanel"})}}}),mt=L({name:"DialogTitle",props:{as:{type:[Object,String],default:"h2"},id:{type:String,default:()=>`headlessui-dialog-title-${te()}`}},setup(e,{attrs:t,slots:l}){let n=le("DialogTitle");return P(()=>{n.setTitleId(e.id),F(()=>n.setTitleId(null))}),()=>{let{id:a,...o}=e;return $({ourProps:{id:a},theirProps:o,slot:{open:n.dialogState.value===0},attrs:t,slots:l,name:"DialogTitle"})}}});export{vt as G,pt as U,mt as V,Y as a,Q as f};