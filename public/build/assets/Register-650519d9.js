import{_ as p,T as g,r as a,o as m,c as v,a as l,d as k,e as N,b as e,f as u,w as f,v as c,j as h,F as y}from"./app-a0f2337f.js";const w={data(){return{isDisabled:!0}},props:{flash:Object},methods:{validateInput(){this.form.phone_number=this.form.phone_number.replace(/[^0-9]/g,""),this.form.phone_number.length>7&&!isNaN(this.form.phone_number)?this.isDisabled=!1:this.isDisabled=!0,this.form.phone_number.length>15&&(this.form.phone_number=this.form.phone_number.slice(0,15))},register(){this.form.post(route("register"),{preserveState:!1})}},setup(){return{form:g({name:"",phone_number:""})}}},D={class:"xl:w-[30%] mx-6 xl:mx-auto"},L={class:"flex justify-center py-10"},V={class:"xl:px-8 xl:py-12 xl:border xl:rounded-xl xl:mb-20"},B=e("div",{class:"text-2xl text-center font-semibold mb-8"},"Daftar",-1),j={class:"mb-6"},C=e("div",{class:"text-sm font-medium mb-2"},"Nama Lengkap",-1),H={class:"mb-8"},I=e("div",{class:"text-sm font-medium mb-2"},"Nomor HP",-1),P=e("div",{class:"text-xs text-zinc-500 mt-2"},"Pastikan nomor HP terhubung ke WhatsApp",-1),T=["disabled"],F={class:"mt-8 text-center text-sm"};function S(r,t,i,o,U,n){const x=a("Head"),_=a("Notif"),b=a("Logo"),d=a("Link");return m(),v(y,null,[l(x,{title:"Daftar"}),i.flash.error||i.flash.success?(m(),k(_,{key:0,flash:i.flash},null,8,["flash"])):N("",!0),e("div",D,[e("div",L,[l(d,{href:r.route("home")},{default:u(()=>[l(b,{class:"h-10"})]),_:1},8,["href"])]),e("div",V,[B,e("div",null,[e("div",j,[C,f(e("input",{"onUpdate:modelValue":t[0]||(t[0]=s=>o.form.name=s),type:"text",class:"border-gray-300 rounded-lg w-full text-sm",placeholder:"Nama Depan & Nama Belakang"},null,512),[[c,o.form.name]])]),e("div",H,[I,f(e("input",{"onUpdate:modelValue":t[1]||(t[1]=s=>o.form.phone_number=s),onInput:t[2]||(t[2]=(...s)=>n.validateInput&&n.validateInput(...s)),type:"text",class:"border-gray-300 rounded-lg w-full text-sm",placeholder:"08xxxxxxxxxx"},null,544),[[c,o.form.phone_number]]),P]),e("button",{type:"button",onClick:t[3]||(t[3]=(...s)=>n.register&&n.register(...s)),disabled:o.form.processing,class:"py-3 rounded-full bg-lime-600 hover:bg-lime-700 text-white w-full font-semibold disabled:bg-slate-300 disabled:text-slate-500"}," Lanjut ",8,T)]),e("div",F,[h(" Sudah punya akun? "),l(d,{href:r.route("login"),class:"text-lime-600 font-semibold"},{default:u(()=>[h("Login")]),_:1},8,["href"])])])])],64)}const A=p(w,[["render",S]]);export{A as default};
