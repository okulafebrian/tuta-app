import{_ as h,T as p,r as n,o as x,c as _,a,b as e,w as c,t as b,i as g,g as v,v as y,n as k,j as f,F as D}from"./app-a798eb3e.js";const w={data(){return{success:this.$page.props.flash.success,isDisabled:!0}},methods:{enforceFourDigits(){this.form.code=this.form.code.replace(/\D/g,""),this.form.code.length>6&&(this.form.code=this.form.code.slice(0,6))},verify(){this.form.post(route("verification-phone.verify"),{preserveState:!1})}},watch:{"form.code"(){this.isDisabled=this.form.code.length<4}},setup(){return{form:p({code:""})}}},V={class:"xl:w-[30%] mx-4 xl:mx-auto"},T={class:"flex justify-center py-10"},F={class:"xl:px-8 xl:py-12 xl:border xl:rounded-xl"},K={class:"text-center mb-8"},L=e("div",{class:"text-xl font-semibold mb-2"}," Masukkan Kode Verifikasi ",-1),B={class:"text-sm"},C=["disabled"],M={class:"mt-8 text-center text-sm"};function N(o,s,P,i,l,r){const m=n("Head"),u=n("Logo"),d=n("Link");return x(),_(D,null,[a(m,{title:"Verifikasi OTP"}),e("div",V,[e("div",T,[a(d,{href:o.route("home")},{default:c(()=>[a(u,{class:"h-10"})]),_:1},8,["href"])]),e("div",F,[e("div",K,[L,e("div",B," Kode verifikasi telah dikirim melalui WhatsApp ke "+b(o.$page.props.auth.user.phone)+". ",1)]),e("form",{onSubmit:s[2]||(s[2]=g((...t)=>r.verify&&r.verify(...t),["prevent"]))},[v(e("input",{"onUpdate:modelValue":s[0]||(s[0]=t=>i.form.code=t),onInput:s[1]||(s[1]=(...t)=>r.enforceFourDigits&&r.enforceFourDigits(...t)),type:"text",class:"border-gray-300 rounded-lg w-full text-center text-3xl font-semibold mb-8",style:{"letter-spacing":"0.5rem"},autofocus:"",required:""},null,544),[[y,i.form.code]]),e("button",{type:"submit",class:k(["py-3 rounded-full bg-lime-600 w-full font-semibold",i.form.processing||l.isDisabled?"bg-slate-200 text-slate-400":"text-white"]),disabled:i.form.processing||l.isDisabled}," Konfirmasi ",10,C)],32),e("div",M,[f(" Tidak menerima kode OTP? "),a(d,{href:o.route("verification-phone.send"),class:"text-lime-600 font-semibold"},{default:c(()=>[f("Kirim Ulang")]),_:1},8,["href"])])])])],64)}const j=h(w,[["render",N]]);export{j as default};