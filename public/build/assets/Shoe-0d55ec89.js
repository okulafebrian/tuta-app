import{_ as y}from"./GuestLayout-de0b3a49.js";import{i as k,Z as w,T as v,r as f,o as s,f as d,a as b,w as M,F as m,b as e,j as h,t as c,g as P,e as L,q as u,B as C,n as U,S as g}from"./app-541a671a.js";import{_ as V}from"./_plugin-vue_export-helper-c27b6911.js";const H={data(){return{selectedPhotoIndex:0,more:0}},components:{GuestLayout:y,Link:k,Head:w,useForm:v},props:{shoe:Object,colors:Object,sizes:Object},computed:{selectedPhotoUrl(){return"/storage/shoes/"+this.shoe.code+"/"+this.shoe.photos[this.selectedPhotoIndex]}},methods:{formatNumber(l){return l.toLocaleString("id-ID")},selectPhoto(l){this.selectedPhotoIndex=l},readMore(){this.more=!this.more}},setup(l){return{form:v({shoe_id:l.shoe.id,color:"",size:"",quantity:1})}}},S={class:"px-4 lg:px-20 py-24"},T={class:"grid lg:grid-cols-3 gap-6 lg:gap-12"},N={class:"overflow-hidden"},j=["src"],B={class:"relative overflow-hidden"},I={class:"overflow-hidden"},q={class:"flex space-x-4 overflow-x-auto md:overflow-hidden"},z=["onClick"],D=["src"],F={class:"text-sm font-semibold text-zinc-400 uppercase mb-2"},G={class:"text-lg mb-2"},O={class:"flex gap-2 text-xl"},R={class:"font-semibold"},E={key:0,class:"text-gray-500 line-through"},J=e("hr",{class:"my-4"},null,-1),W=e("h4",{class:"font-semibold mb-2"},"Deskripsi Produk",-1),Z={key:0},A=["innerHTML"],K={key:1},Q=["innerHTML"],X=e("hr",{class:"lg:hidden"},null,-1),Y={class:"mb-6"},$=e("div",{class:"font-medium mb-2"},"Pilih Warna",-1),ee={class:"grid grid-cols-2 gap-2"},oe=["onUpdate:modelValue","id","value"],te=["for"],se={class:"mb-6"},de=e("div",{class:"font-medium mb-2"},"Pilih Ukuran",-1),ne={class:"grid grid-cols-4 gap-2"},ie=["onUpdate:modelValue","id","value"],le=["for"],re={class:"mb-8"},ae=e("div",{class:"font-medium mb-2"},"Jumlah",-1),ce=e("button",{type:"submit",class:"rounded-full bg-lime-600 hover:bg-lime-700 py-3 font-medium text-white w-full"}," Tambah ke keranjang ",-1);function me(l,n,t,r,_,i){const x=f("Head"),p=f("GuestLayout");return s(),d(m,null,[b(x,{title:t.shoe.name},null,8,["title"]),b(p,null,{default:M(()=>[e("div",S,[e("div",T,[e("div",N,[e("div",null,[e("img",{src:i.selectedPhotoUrl},null,8,j)]),e("div",B,[e("div",I,[e("div",q,[(s(!0),d(m,null,h(t.shoe.photos,(o,a)=>(s(),d("div",{onClick:he=>i.selectPhoto(a),class:"flex-grow"},[e("img",{src:"/storage/shoes/"+t.shoe.code+"/"+o,class:U(["rounded-md overflow-hidden hover:brightness-90 max-w-none h-24",{"brightness-90":_.selectedPhotoIndex===a}])},null,10,D)],8,z))),256))])])])]),e("div",null,[e("p",F,c(t.shoe.category.name),1),e("h4",G,c(t.shoe.name),1),e("div",O,[e("div",R," Rp"+c(i.formatNumber(t.shoe.discount_price??t.shoe.price)),1),t.shoe.discount_price?(s(),d("div",E," Rp"+c(i.formatNumber(t.shoe.price)),1)):P("",!0)]),J,e("div",null,[W,_.more?(s(),d("div",Z,[e("div",{innerHTML:t.shoe.description,class:"prose select-none text-sm mb-2"},null,8,A),e("button",{onClick:n[0]||(n[0]=(...o)=>i.readMore&&i.readMore(...o)),type:"button",class:"font-semibold text-lime-600 hover:text-lime-600 text-sm"}," Sembunyikan ")])):(s(),d("div",K,[e("div",{innerHTML:t.shoe.description,class:"prose select-none text-sm line-clamp-4 mb-2"},null,8,Q),e("button",{onClick:n[1]||(n[1]=(...o)=>i.readMore&&i.readMore(...o)),type:"button",class:"font-semibold text-lime-600 hover:text-lime-600 text-sm"}," Baca Selengkapnya ")]))])]),X,e("div",null,[e("form",{onSubmit:n[3]||(n[3]=L(o=>r.form.post(l.route("cart.add")),["prevent"]))},[e("div",Y,[$,e("div",ee,[(s(!0),d(m,null,h(t.colors,o=>(s(),d("div",null,[u(e("input",{"onUpdate:modelValue":a=>r.form.color=a,id:"c"+o.id,value:o.id,type:"radio",class:"hidden peer"},null,8,oe),[[g,r.form.color]]),e("label",{for:"c"+o.id,class:"border rounded-md block text-center py-2 peer-checked:ring-1 peer-checked:ring-black"},c(o.name),9,te)]))),256))])]),e("div",se,[de,e("div",ne,[(s(!0),d(m,null,h(t.sizes,o=>(s(),d("div",null,[u(e("input",{"onUpdate:modelValue":a=>r.form.size=a,id:"s"+o.id,value:o.id,type:"radio",class:"hidden peer"},null,8,ie),[[g,r.form.size]]),e("label",{for:"s"+o.id,class:"border rounded-md block text-center py-2 peer-checked:ring-1 peer-checked:ring-black"},c(o.name),9,le)]))),256))])]),e("div",re,[ae,u(e("input",{"onUpdate:modelValue":n[2]||(n[2]=o=>r.form.quantity=o),type:"number",class:"border border-gray-300 rounded-md"},null,512),[[C,r.form.quantity]])]),ce],32)])])])]),_:1})],64)}const fe=V(H,[["render",me]]);export{fe as default};
