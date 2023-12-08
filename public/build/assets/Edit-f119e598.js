import{A as I}from"./AdminLayout-e0f3cfa6.js";import{_ as R,T as S,r as v,o as d,c as r,a as f,b as e,F as m,f as _,g as h,v as x,h as C,w as z,j as l,d as E,t as u,l as w,e as k}from"./app-a798eb3e.js";import{E as O,r as L,I as D}from"./ImagePreview-b00664fa.js";import"./CheckCircleIcon-b26d9947.js";const F={components:{Editor:O,PhotoIcon:L,ImagePreview:D},props:{shoe:Object,categories:Object,colors:Object,sizes:Object,selectedColors:Object,selectedSizes:Object,stocks:Object,mainPhotos:Array,variantPhotos:Object},watch:{"form.sizes":"updateVariant","form.colors"(s){this.updateVariant(),s.length<1&&(this.form.sizes=[])}},methods:{formattedPrice(){let s=this.form.price.toString().replace(/\D/g,"");s=s.replace(/\B(?=(\d{3})+(?!\d))/g,"."),this.form.price=s},updateVariant(){for(const s of this.form.colors){this.form.stocks[s.id]||(this.form.stocks[s.id]={});for(const o of this.form.sizes)this.stocks[s.id]&&this.stocks[s.id][o.id]!==void 0?this.form.stocks[s.id][o.id]=this.stocks[s.id][o.id]:this.form.stocks[s.id][o.id]=null}},handleImageUpload(s,o){o==="main"?this.form.main_photos[s]={url:URL.createObjectURL(event.target.files[0]),item:event.target.files[0]}:this.form.variant_photos[s]={url:URL.createObjectURL(event.target.files[0]),item:event.target.files[0]};const a=event.target;if(a.files&&a.files[0]){const i=new FileReader;i.onload=P=>{},i.readAsDataURL(a.files[0]),o==="main"&&this.form.main_photos.length<5&&this.form.main_photos.push("")}},removePhoto(s,o){o==="main"?(this.form.main_photos.splice(s,1),(this.form.main_photos.length===0||this.form.main_photos[this.form.main_photos.length-1]!=="")&&this.form.main_photos.push("")):this.form.variant_photos[s]=""},updateShoe(){this.form.price=this.form.price.replace(/\D/g,""),this.form.post(route("shoes.update",this.shoe),{preserveScroll:!0})}},created(){this.updateVariant(),this.form.main_photos.length<5&&this.form.main_photos.push(""),this.formattedPrice()},setup(s){const o=S({_method:"put",main_photos:[],category:s.shoe.category_id,name:s.shoe.name,code:s.shoe.code,price:s.shoe.price,description:s.shoe.description,colors:s.selectedColors.map(a=>({id:a.id,name:a.name})),sizes:s.selectedSizes.map(a=>({id:a.id,name:a.name})),variant_photos:{},stocks:{}});return s.mainPhotos.forEach((a,i)=>{o.main_photos[i]={url:"/storage/shoes/"+s.shoe.code+"/main/"+a,item:a}}),s.colors.forEach(a=>{s.variantPhotos[a.id]&&(o.variant_photos[a.id]={url:"/storage/shoes/"+s.shoe.code+"/"+s.variantPhotos[a.id],item:s.variantPhotos[a.id]})}),{form:o}},layout:I},B={class:"px-40 py-10"},M=e("div",{class:"text-xl font-semibold mb-6"},"Edit Produk",-1),N={class:"bg-white p-8 space-y-6 rounded-lg shadow-sm mb-6"},A=e("div",{class:"font-semibold"},"Informasi Produk",-1),T={class:"text-sm flex items-baseline"},H=e("div",{class:"w-1/6"},[l("Foto Utama "),e("span",{class:"text-red-500"},"*")],-1),K={class:"flex-1"},W=e("div",{class:"mb-2"},"Rasio foto 1:1 (persegi)",-1),q={class:"flex gap-2"},G=["for"],J={class:"h-24 w-24 flex flex-col gap-2 items-center justify-center rounded-md border border-dashed border-gray-300 hover:border-lime-600 text-zinc-500 hover:text-lime-600 overflow-hidden"},Q={class:"text-xs"},X=["id","onChange"],Y={class:"text-sm flex items-center"},Z=e("div",{class:"w-1/6"},[l("Nama Produk "),e("span",{class:"text-red-500"},"*")],-1),$={class:"text-sm flex items-center"},ee=e("div",{class:"w-1/6"},[l("Kode Produk "),e("span",{class:"text-red-500"},"*")],-1),te={class:"text-sm flex items-center"},se=e("div",{class:"w-1/6"},[l("Kategori Produk "),e("span",{class:"text-red-500"},"*")],-1),oe=e("option",{disabled:"",value:""},"Pilih kategori",-1),ie=["value"],ae={class:"text-sm flex items-center"},de=e("div",{class:"w-1/6"},[l("Harga "),e("span",{class:"text-red-500"},"*")],-1),re={class:"flex-1 flex items-center border border-gray-200 bg-gray-100 rounded-md overflow-hidden w-fit"},ne=e("div",{class:"text-sm text-gray-500 font-semibold px-3"},"Rp",-1),le={class:"text-sm flex items-baseline"},ce=e("div",{class:"w-1/6"},[l("Deskripsi Produk "),e("span",{class:"text-red-500"},"*")],-1),me={class:"bg-white p-8 rounded-lg shadow-sm mb-6"},he=e("div",{class:"font-semibold mb-6"},"Informasi Penjualan",-1),fe={class:"flex items-start mb-6"},_e=e("div",{class:"w-1/6 text-sm"},[l("Warna "),e("span",{class:"text-red-500"},"*")],-1),ue={class:"w-5/6 grid grid-cols-7 gap-y-4"},ve={class:"flex items-center"},pe=["value","id"],xe=["for"],ge={class:"flex items-center mb-6"},be=e("div",{class:"w-1/6 text-sm"},[l("Ukuran "),e("span",{class:"text-red-500"},"*")],-1),ye={class:"w-5/6 grid grid-cols-7"},we={class:"flex items-center"},ke=["value","id"],Pe=["for"],Ve={class:"flex items-start"},Ue=e("div",{class:"w-1/6 text-sm"},"Daftar Variasi",-1),je={class:"w-5/6"},Ie={class:"border overflow-hidden rounded-md text-sm"},Re={class:"table-fixed w-full"},Se=e("thead",{class:"font-semibold bg-gray-100 text-gray-500"},[e("tr",{class:"divide-x"},[e("td",{class:"w-2/5 py-2 px-3"},[l("Foto Produk "),e("span",{class:"text-red-500"},"*")]),e("td",{class:"py-2 px-3"},"Warna"),e("td",{class:"py-2 px-3"},"Ukuran"),e("td",{class:"w-1/4 py-2 px-3"},[l("Stok "),e("span",{class:"text-red-500"},"*")])])],-1),Ce=["rowspan"],ze=["for"],Ee={class:"h-24 w-24 flex flex-col gap-2 items-center justify-center rounded-md border border-dashed border-gray-300 hover:border-lime-600 text-zinc-500 hover:text-lime-600 overflow-hidden"},Oe=e("div",{class:"text-xs"},"Tambah Foto",-1),Le=["id","onChange"],De=["rowspan"],Fe={class:"px-3 border-l"},Be={class:"border-l"},Me=["onUpdate:modelValue"],Ne={class:"flex justify-end gap-2 text-sm"};function Ae(s,o,a,i,P,c){const V=v("Head"),b=v("ImagePreview"),y=v("PhotoIcon"),U=v("Editor"),j=v("Link");return d(),r(m,null,[f(V,{title:"Edit Produk"}),e("div",B,[M,e("div",N,[A,e("div",T,[H,e("div",K,[W,e("div",q,[(d(!0),r(m,null,_(i.form.main_photos,(t,n)=>(d(),r("div",{key:n},[t?(d(),E(b,{key:0,source:t.url,onRemovePhoto:p=>c.removePhoto(n,"main")},null,8,["source","onRemovePhoto"])):(d(),r("label",{key:1,for:"mainPhotos"+n,class:"flex flex-col items-center justify-center cursor-pointer"},[e("div",J,[f(y,{class:"w-8 h-8"}),e("div",Q,"Foto "+u(n==0?"Sampul":"("+n+"/5)"),1)]),e("input",{id:"mainPhotos"+n,type:"file",class:"hidden",onChange:p=>c.handleImageUpload(n,"main")},null,40,X)],8,G))]))),128))])])]),e("div",Y,[Z,h(e("input",{"onUpdate:modelValue":o[0]||(o[0]=t=>i.form.name=t),type:"text",class:"w-5/6 text-sm border-gray-200 rounded-md"},null,512),[[x,i.form.name]])]),e("div",$,[ee,h(e("input",{"onUpdate:modelValue":o[1]||(o[1]=t=>i.form.code=t),type:"text",class:"w-5/6 text-sm border-gray-200 rounded-md placeholder:text-slate-400",placeholder:"Mohon masukkan"},null,512),[[x,i.form.code]])]),e("div",te,[se,h(e("select",{"onUpdate:modelValue":o[2]||(o[2]=t=>i.form.category=t),class:"text-sm border-gray-200 rounded-md w-5/6"},[oe,(d(!0),r(m,null,_(a.categories,t=>(d(),r("option",{value:t.id,key:t.id},u(t.name),9,ie))),128))],512),[[C,i.form.category]])]),e("div",ae,[de,e("div",re,[ne,h(e("input",{type:"text",class:"text-sm border-0 focus:ring-0 w-full","onUpdate:modelValue":o[3]||(o[3]=t=>i.form.price=t),onInput:o[4]||(o[4]=(...t)=>c.formattedPrice&&c.formattedPrice(...t))},null,544),[[x,i.form.price]])])]),e("div",le,[ce,f(U,{modelValue:i.form.description,"onUpdate:modelValue":o[5]||(o[5]=t=>i.form.description=t),class:"w-5/6"},null,8,["modelValue"])])]),e("div",me,[he,e("div",fe,[_e,e("div",ue,[(d(!0),r(m,null,_(a.colors,t=>(d(),r("div",ve,[h(e("input",{"onUpdate:modelValue":o[6]||(o[6]=n=>i.form.colors=n),value:t,id:t.id,type:"checkbox",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-200 rounded focus:ring-blue-500"},null,8,pe),[[w,i.form.colors]]),e("label",{for:t.id,class:"ml-2 text-sm"},u(t.name),9,xe)]))),256))])]),e("div",ge,[be,e("div",ye,[(d(!0),r(m,null,_(a.sizes,t=>(d(),r("div",we,[h(e("input",{"onUpdate:modelValue":o[7]||(o[7]=n=>i.form.sizes=n),value:t,id:t.id,type:"checkbox",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-200 rounded focus:ring-blue-500"},null,8,ke),[[w,i.form.sizes]]),e("label",{for:t.id,class:"ml-2 text-sm"},u(t.name),9,Pe)]))),256))])]),e("div",Ve,[Ue,e("div",je,[e("div",Ie,[e("table",Re,[Se,e("tbody",null,[(d(!0),r(m,null,_(i.form.colors,t=>(d(),r(m,null,[(d(!0),r(m,null,_(i.form.sizes,(n,p)=>(d(),r("tr",{key:`${t}-${n}`,class:"border-t"},[p===0?(d(),r("td",{key:0,class:"py-2 px-3",rowspan:i.form.sizes.length},[i.form.variant_photos[t.id]?(d(),r("div",{key:t.id,class:"flex justify-center"},[f(b,{source:i.form.variant_photos[t.id].url,onRemovePhoto:g=>c.removePhoto(t.id,"variant")},null,8,["source","onRemovePhoto"])])):(d(),r("label",{key:1,for:"variant_photos"+t.id,class:"flex flex-col items-center cursor-pointer"},[e("div",Ee,[f(y,{class:"w-8 h-8"}),Oe]),e("input",{id:"variant_photos"+t.id,type:"file",class:"hidden",onChange:g=>c.handleImageUpload(t.id,"variant")},null,40,Le)],8,ze))],8,Ce)):k("",!0),p===0?(d(),r("td",{key:1,class:"px-3 border-l",rowspan:i.form.sizes.length},u(t.name),9,De)):k("",!0),e("td",Fe,u(n.name),1),e("td",Be,[h(e("input",{"onUpdate:modelValue":g=>i.form.stocks[t.id][n.id]=g,type:"number",placeholder:"Mohon masukkan",class:"border-0 text-sm w-full focus:ring-0 placeholder:text-neutral-400"},null,8,Me),[[x,i.form.stocks[t.id][n.id]]])])]))),128))],64))),256))])])])])])]),e("div",Ne,[f(j,{href:s.route("shoes.index"),class:"border border-gray-200 bg-white hover:bg-gray-50 font-medium py-2 px-10 rounded-md"},{default:z(()=>[l(" Batal ")]),_:1},8,["href"]),e("button",{type:"button",onClick:o[8]||(o[8]=(...t)=>c.updateShoe&&c.updateShoe(...t)),class:"border bg-lime-600 hover:bg-lime-700 text-white font-medium py-2 px-10 rounded-md"}," Simpan ")])])],64)}const qe=R(F,[["render",Ae]]);export{qe as default};