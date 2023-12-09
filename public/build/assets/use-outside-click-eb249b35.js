import{a4 as p,E as h,L as x,V as F,D as b,x as P,z as g}from"./app-a0f2337f.js";var S=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(S||{});function N(e){if(p.isServer)return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let t=h(e);if(t)return t.ownerDocument}return document}let E=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var D=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(D||{}),T=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(T||{}),M=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(M||{});function y(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(E)).sort((t,o)=>Math.sign((t.tabIndex||Number.MAX_SAFE_INTEGER)-(o.tabIndex||Number.MAX_SAFE_INTEGER)))}var A=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(A||{});function L(e,t=0){var o;return e===((o=N(e))==null?void 0:o.body)?!1:x(t,{0(){return e.matches(E)},1(){let u=e;for(;u!==null;){if(u.matches(E))return!0;u=u.parentElement}return!1}})}function K(e){let t=N(e);F(()=>{t&&!L(t.activeElement,0)&&I(e)})}var O=(e=>(e[e.Keyboard=0]="Keyboard",e[e.Mouse=1]="Mouse",e))(O||{});typeof window<"u"&&typeof document<"u"&&(document.addEventListener("keydown",e=>{e.metaKey||e.altKey||e.ctrlKey||(document.documentElement.dataset.headlessuiFocusVisible="")},!0),document.addEventListener("click",e=>{e.detail===1?delete document.documentElement.dataset.headlessuiFocusVisible:e.detail===0&&(document.documentElement.dataset.headlessuiFocusVisible="")},!0));function I(e){e==null||e.focus({preventScroll:!0})}let _=["textarea","input"].join(",");function U(e){var t,o;return(o=(t=e==null?void 0:e.matches)==null?void 0:t.call(e,_))!=null?o:!1}function k(e,t=o=>o){return e.slice().sort((o,u)=>{let i=t(o),n=t(u);if(i===null||n===null)return 0;let l=i.compareDocumentPosition(n);return l&Node.DOCUMENT_POSITION_FOLLOWING?-1:l&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function G(e,t){return $(y(),t,{relativeTo:e})}function $(e,t,{sorted:o=!0,relativeTo:u=null,skipElements:i=[]}={}){var n;let l=(n=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?n:document,r=Array.isArray(e)?o?k(e):e:y(e);i.length>0&&r.length>1&&(r=r.filter(c=>!i.includes(c))),u=u??l.activeElement;let w=(()=>{if(t&5)return 1;if(t&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),s=(()=>{if(t&1)return 0;if(t&2)return Math.max(0,r.indexOf(u))-1;if(t&4)return Math.max(0,r.indexOf(u))+1;if(t&8)return r.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),a=t&32?{preventScroll:!0}:{},m=0,f=r.length,d;do{if(m>=f||m+f<=0)return 0;let c=s+m;if(t&16)c=(c+f)%f;else{if(c<0)return 3;if(c>=f)return 1}d=r[c],d==null||d.focus(a),m+=w}while(d!==l.activeElement);return t&6&&U(d)&&d.select(),2}function v(e,t,o){p.isServer||b(u=>{document.addEventListener(e,t,o),u(()=>document.removeEventListener(e,t,o))})}function H(e,t,o){p.isServer||b(u=>{window.addEventListener(e,t,o),u(()=>window.removeEventListener(e,t,o))})}function V(e,t,o=g(()=>!0)){function u(n,l){if(!o.value||n.defaultPrevented)return;let r=l(n);if(r===null||!r.getRootNode().contains(r))return;let w=function s(a){return typeof a=="function"?s(a()):Array.isArray(a)||a instanceof Set?a:[a]}(e);for(let s of w){if(s===null)continue;let a=s instanceof HTMLElement?s:h(s);if(a!=null&&a.contains(r)||n.composed&&n.composedPath().includes(a))return}return!L(r,A.Loose)&&r.tabIndex!==-1&&n.preventDefault(),t(n,r)}let i=P(null);v("pointerdown",n=>{var l,r;o.value&&(i.value=((r=(l=n.composedPath)==null?void 0:l.call(n))==null?void 0:r[0])||n.target)},!0),v("mousedown",n=>{var l,r;o.value&&(i.value=((r=(l=n.composedPath)==null?void 0:l.call(n))==null?void 0:r[0])||n.target)},!0),v("click",n=>{i.value&&(u(n,()=>i.value),i.value=null)},!0),v("touchend",n=>u(n,()=>n.target instanceof HTMLElement?n.target:null),!0),H("blur",n=>u(n,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}export{D as N,k as O,$ as P,I as S,T,K as _,H as a,A as h,N as m,S as o,G as v,L as w,V as y};
